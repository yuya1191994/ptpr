<?php

class DeletePropertyImage {
    public function deleteImage(string $deleteImages, string $pKey) {
        $deleteImagesArray = explode(';', $deleteImages);
        $path = $_SERVER["DOCUMENT_ROOT"]."/ptpr-dev";
        $errMsg = '';
        foreach ($deleteImagesArray as $deleteImage) {
            $absolutePath = $path.substr($deleteImage, 2);
            if (!empty($deleteImage)) {
                if (unlink($absolutePath)) {
                    echo $deleteImage."を削除しました";
                } else {
                    $errMsg = "$deleteImage の削除に失敗しました";
                    echo $errMsg;
                    return $errMsg;
                }
            }
        }
    }

    public function deleteImageAll(string $pKey) {
        $deleteDirPath = $_SERVER["DOCUMENT_ROOT"]."/ptpr-dev/assets/images/properties/$pKey";
        $errMsg = '';
        if(is_dir($deleteDirPath)) {
            foreach (glob($deleteDirPath . '/{*,.[!.]*,..?*}', GLOB_BRACE) as $path) {
                if (is_file($path)) {
                    if (!unlink($path)) {
                        $errMsg = "ファイル $path の削除に失敗しました<br>";
                        return $errMsg;
                    }
                }
            }
            if (!rmdir($deleteDirPath)) {
                $errMsg = "ディレクトリ$deleteDirPath の削除に失敗しました";
                return $errMsg;
            }
        }
    }
}