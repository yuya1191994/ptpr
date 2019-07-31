<?php
// require "form/getCsv.php";
require_once ($_SERVER['DOCUMENT_ROOT']."/ptpr-dev/src/action/admin/csvHandle.php");
require_once ($_SERVER['DOCUMENT_ROOT']."/ptpr-dev/src/action/admin/DBHandle.php");
// require_once("util/connectDatabase.php");

// $connectDatabase = new ConnectDatabase();
// $controllDB = new ControllDB();
// $conn = $connectDatabase->db_connect("test");
// $controllDB->insertRoomInfoFromCsv();
// $connectDatabase->db_close($conn, "test");

$arr = $_POST['read_csv'];
$controllCsv = new ControllCsv();
$hoge = $controllCsv->extractCsvFile($arr);

print_r($hoge);
// $filePath = '/Users/yanoyuuya/Downloads/bkkn_list_20190702210406.csv';
// $extracDataFromCsv->extracDataFromCsv($filePath);
?>