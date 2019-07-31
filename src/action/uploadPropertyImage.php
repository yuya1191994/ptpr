<?php

class UploadPropertyImage {
    public function uploadImage(array $images, string $pKey) {
        $reseiveImages = $_FILES['upload-images']['name'];
        $receiveImagesCnt = count($_FILES['upload-images']['name']);
        $errmsg = "";

        for ($i = 0; $i < $receiveImagesCnt; $i ++) {
            $uploadPath = $_SERVER['DOCUMENT_ROOT'] . "/ptpr-dev/assets/images/properties/$pKey/";
            $tmp = $_FILES['upload-images']['tmp_name'][$i];
            clearstatcache();

            // ディレクトリが存在しなければ新規作成
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath);
            }

            // アップロード処理
            // ファイル名に日本語が含まれている時のバグを未然に防ぐため、
            // ファイル名は現在日付_{idx}に変更して登録しておく
            $uploadImage = $reseiveImages[$i];
            $suffixs     = [".jpg",  ".jpeg",  ".png",  ".gif"];
            foreach ($suffixs as $key => $suffix) {
                if (strpos($uploadImage, $suffix)) {
                    $uploadPath = $uploadPath.date('YmdHis')."_".($i+1).$suffix;
                    // アップロード処理
                    if (!move_uploaded_file($tmp, $uploadPath)) {
                        $errmsg = "【エラー】$uploadPath のアップロードに失敗しました。" . $_FILES['upload-images']['error'][$i];
                        return $errMsg;
                    }
                }
            }
        }
    }
}
