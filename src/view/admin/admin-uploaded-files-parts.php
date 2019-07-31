<?php

$files = glob($_SERVER['DOCUMENT_ROOT'] . "/ptpr-dev/csv/*.csv");
$insertFiles = "";
if (count($files) > 0) {
    echo
    '<p>▼アップロード済ファイル▼</p><div class="upload-csv-list">';
    foreach ($files as $fileName) {
        // ファイル名のみ抜き出して表示
        $fileName = substr($fileName, strpos($fileName, "bkkn_list_"));
        echo '<form action="action/deleteCsv.php" method="post">' . $fileName . '
                              <input type="hidden" name="delete-csv" value="' . $fileName . '">
                              <input type="submit" value="削除"><br>
                            </form>';

        // 一括登録ボタンのvalueを設定
        $insertFiles .= $fileName.";";
    }
    echo '</div>';
?>
    <form action="csv-confirm.php" method="post" target="_blank">
    <input type="hidden" name="insert-files" value="<? echo $insertFiles ?>">
    <input type="submit" class="btn" value="このファイルを一括登録">
</form>

<? } ?>
