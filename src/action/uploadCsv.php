<?php
// 本日取得したcsvファイルのみアップロードを許容する
$approvalUploadCsvCnt = 0;
$reseiveCsvFiles = $_FILES['upload-csv']['name'];
$receiveCsvCnt = count($_FILES['upload-csv']['name']);

for ($i = 0; $i < $receiveCsvCnt; $i ++) {
    $uploadCsvFile = $reseiveCsvFiles[$i];
    $currentDate = "bkkn_list_".date("Ymd");
    if (strpos($uploadCsvFile, $currentDate) === false) {
        echo "【エラー】本日日付のファイルのみアップロードしてください。<br>エラー対象ファイル: $uploadCsvFile<br>";
    } else {
        $approvalUploadCsvCnt ++;
    }
}

// アップロード処理
if ($approvalUploadCsvCnt == $receiveCsvCnt) {
    $uploadCnt = 0;
    for ($i = 0; $i < $receiveCsvCnt; $i ++) {
        $uploadCsvFile = $reseiveCsvFiles[$i];
        $uploadPath = $_SERVER['DOCUMENT_ROOT'] . "/ptpr-dev/csv/" . $uploadCsvFile;
        $tmp = $_FILES['upload-csv']['tmp_name'][$i];

        clearstatcache();
        if (move_uploaded_file($tmp, $uploadPath)) {
            $uploadCnt ++;
            // すべてアップロード完了したらリダイレクト
            if ($receiveCsvCnt - 1 == $i) {
                http_response_code(301);
                header("Location: ../admin.php");
                exit();
            }
        } else {
            echo "【エラー】$uploadCsvFile のアップロードに失敗しました。" . $_FILES['upload-csv']['error'][$i];
        }
    }
}

