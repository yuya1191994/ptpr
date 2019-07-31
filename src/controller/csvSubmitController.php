<?php
require_once ($_SERVER['DOCUMENT_ROOT']."/ptpr-dev/src/action/DBHandle.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/ptpr-dev/src/action/csvHandle.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/ptpr-dev/src/action/DeletePropertyImage.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/ptpr-dev/src/service/issueSql.php");

/*
 * アップロードされているcsvファイルをもとに、払い替え用SQLを発行する処理
 */

$insertFiles = explode(';', $_POST['insert-files']);

// アップロードされているcsv上の物件ををすべて読み込みJSON形式で取得
$csvHandle = new CsvHandle();
$jsonDataFromCsv = $csvHandle->extractCsvFile($insertFiles);

// DB上の在庫物件をすべて読み込みJSON形式で取得
$issueSQL = new IssueSQL();
$DBHandle = new DBHandle();
$allSelectQuery = $issueSQL->issueSelectQuery();
$jsonDataFromDB = $DBHandle->selectReturnJson($allSelectQuery);

// csvとDBの物件を比べ、洗い替え用のSQLを発行する。
$reversalSQLs = $issueSQL->issueReversalEntriesSql($jsonDataFromCsv, $jsonDataFromDB);

// print_r($reversalSQLs);

// 洗い替えSQLを実行する
$sqlSccessFlg = $DBHandle->doQuerys($reversalSQLs);

// 成功したらOKディレクトリ、失敗したらNGディレクトリへ
$mvDir = $_SERVER['DOCUMENT_ROOT']."/ptpr-dev/csv/";
$OKDir = $mvDir."OK/";
$NGDir = $mvDir."NG/";
if (empty($sqlSccessFlg)) {
    foreach ($insertFiles as $file) {
        if (!empty($file)) { rename($mvDir.$file, $OKDir.$file); }
    }
} else {
    echo $sqlSccessFlg;
    foreach ($insertFiles as $file) {
        if (!empty($file)) { rename($mvDir.$file, $NGDir.$file); }
    }
}

// 削除する物件はディレクトリ上の画像も完全削除する
$deletePropertyImage = new DeletePropertyImage();
$deleteSuccessFlg = '';
foreach ($reversalSQLs as $key => $row) {
    if (strpos($row, 'delete from') !== false) {
        $deleteSuccessFlg = $deletePropertyImage->deleteImageAll($key);
        if (!empty($deleteSuccessFlg)) {
            echo $deleteSuccessFlg;
        }
    }
}

if (empty($sqlSccessFlg) && empty($deleteSuccessFlg)) {
?>
<div style="text-align: center;">
    一括登録が完了しました。<br>
    <input type="button" onclick="self.close();" value="閉じる">
</div>
<? }?>