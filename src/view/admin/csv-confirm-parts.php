<?php
require_once ($_SERVER['DOCUMENT_ROOT']."/ptpr-dev/src/action/DBHandle.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/ptpr-dev/src/action/csvHandle.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/ptpr-dev/src/service/issueSql.php");

/*
 * アップロードされているcsvファイルをもとに、払い替え用SQLを発行する処理
 */

$insertFiles = explode(';', $_POST['insert-files']);

// アップロードされているcsv上の物件ををすべて読み込みJSON形式で取得
$csvHandle = new CsvHandle();
$jsonDataFromCsv = $csvHandle->extractCsvFile($insertFiles);

// DB上の在庫物件をすべて読み込みJSON形式で取得
$DBHandle = new DBHandle();
$issueSQL = new IssueSQL();
$allSelectQuery = $issueSQL->issueSelectQuery();
$jsonDataFromDB = $DBHandle->selectReturnJson($allSelectQuery);

// csvとDBの物件を比べ、洗い替え用のSQLを発行する。
$reversalSQLs = $issueSQL->issueReversalEntriesSql($jsonDataFromCsv, $jsonDataFromDB);


// 予定される新着物件と募集終了物件の数を取得
$insertCnt = 0;
$deleteCnt = 0;
foreach ($reversalSQLs as $row) {
    if (strpos($row, 'insert into') !== false) {
        $insertCnt ++;
    } else if (strpos($row, 'delete from') !== false) {
        $deleteCnt ++;
    }
}