<?php
include_once ($_SERVER["DOCUMENT_ROOT"] . "/ptpr-dev/src/action/uploadPropertyImage.php");

$pKey = $_POST['pkey'];
$uploadImages = $_FILES['upload-images']['name'];
// アップロードされた物件画像があればディレクトリにアップロードする
if (! empty($uploadImages[0])) {
    $uploadPropertyImage = new UploadPropertyImage();
    $uploadSuccessFlg = $uploadPropertyImage->uploadImage($uploadImages, $pKey);
}

if (empty($uploadSuccessFlg)) {
    print "<script language='javascript' type='text/javascript'>self.close();</script>";
}
