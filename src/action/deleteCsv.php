<?php

$deleteCsvFile = $_SERVER['DOCUMENT_ROOT']."/ptpr-dev/csv/".$_POST['delete-csv'];
echo $deleteCsvFile;
if (unlink($deleteCsvFile)) {
    http_response_code(301);
    header("Location: ../admin.php");
    exit();
} else {
    echo "$deleteCsvFile の削除に失敗しました。";
}