<?php
include_once ($_SERVER["DOCUMENT_ROOT"] . "/ptpr-dev/src/service/issueSql.php");
include_once ($_SERVER["DOCUMENT_ROOT"] . "/ptpr-dev/src/action/DBHandle.php");
include_once ($_SERVER["DOCUMENT_ROOT"] . "/ptpr-dev/src/action/uploadPropertyImage.php");
include_once ($_SERVER["DOCUMENT_ROOT"] . "/ptpr-dev/src/action/deletePropertyImage.php");
include_once ($_SERVER["DOCUMENT_ROOT"] . "/ptpr-dev/src/action/renamePropertyImage.php");
include_once ($_SERVER["DOCUMENT_ROOT"] . "/ptpr-dev/src/util/seculityFunctions.php");

$pKey = $_POST['pkey'];
$sortImages = $_POST['sort-image-path'];
$deleteImages = $_POST['delete-image-path'];

if (! empty($sortImages)) {
    // 画像ファイルのファイル名を連番数値に変更する
    $renamePropertyImage = new RenamePropertyImage();
    $renameImageSuccessFlg = $renamePropertyImage->sortImage($sortImages, $pKey);
    if (! empty($renameImageSuccessFlg)) {
        return;
    }
}

// 削除された物件画像があればディレクトリから削除する
if (! empty($deleteImages)) {
    $deletePropertyImage = new DeletePropertyImage();
    $deleteSuccessFlg = $deletePropertyImage->deleteImage($deleteImages, $pKey);
    if (! empty($deleteSuccessFlg)) {
        return;
    }
}

// 物件画像の有無を取得し、DB登録値の画像フラグを判別
$imgs = glob($_SERVER['DOCUMENT_ROOT'] . "/ptpr-dev/assets/images/properties/$pKey/*");
$roomPhotoFlg = (count($imgs) > 0) ? 1 : 0;

// 物件情報登録処理
$propertyInfo = array();
$propertyInfo['FAX_NUMBER'] = $_POST['fax-number'];
$propertyInfo['PROPERTY_NAME'] = $_POST['property-name'];
$propertyInfo['ROOM_NUMBER'] = $_POST['room-number'];
$propertyInfo['REMARKS_2'] = $_POST['remarks-2'];
$propertyInfo['AD_FLAG'] = $_POST['ad-flag'];
$propertyInfo['RECOMMEND_FLAG'] = $_POST['recommend-flag'];
$propertyInfo['MEMO'] = $_POST['memo'];
$propertyInfo['RELEASE_FLAG'] = $_POST['release-flag'];
$propertyInfo['ROOM_PHOTO'] = $roomPhotoFlg;
$propertyInfo['FREE_WORD'] = $_POST["addresses"].$_POST["property-name"].$_POST["train-route"].$_POST["station-name"].$_POST["building-type"].$_POST["remarks-2"];

foreach ($propertyInfo as $val) {
    if (is_array($val)) {
        foreach($val as $v) {
            $validateErr = str_validate($v);
            if ($validateErr) {
                echo $validateErr;
                return;
            }
        }
    } else if (is_string($val)){
        $validateErr = str_validate($val);
        if ($validateErr) {
            echo $validateErr;
            return;
        }
    }
}


$issueSql = new IssueSql();
$updateSql = $issueSql->updatePropertyInfo($propertyInfo, $pKey);

$dbHandle = new DBHandle();
$dbHandle->doQuery($updateSql);
