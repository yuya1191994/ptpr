<?php
include_once ($_SERVER["DOCUMENT_ROOT"] . "/ptpr-dev/src/service/issueSql.php");
include_once ($_SERVER["DOCUMENT_ROOT"] . "/ptpr-dev/src/action/DBHandle.php");
include_once ($_SERVER["DOCUMENT_ROOT"] . "/ptpr-dev/src/action/deletePropertyImage.php");

$pKey = $_POST['pkey'];

// ディレクトリ上の画像をすべて削除
$deletePropertyImage = new DeletePropertyImage();
$deleteSuccessFlg = $deletePropertyImage->deleteImageAll($pKey);
if (!empty($deleteSuccessFlg)) { echo $deleteSuccessFlg; return; }

// 削除SQL発行
$issueSql = new IssueSql();
$deleteSql = $issueSql->deletePropertyInfo($pKey);

// 物件情報削除
$dbHandle = new DBHandle();
$dbHandle->doQuery($deleteSql);


