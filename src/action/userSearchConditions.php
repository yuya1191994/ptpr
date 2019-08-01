<?php
require_once ($_SERVER['DOCUMENT_ROOT']."/ptpr-dev/src/action/DBHandle.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/ptpr-dev/src/service/issueSql.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/ptpr-dev/src/util/seculityFunctions.php");

$whereCondition = [];

if (!empty($_GET['address1']))
{ $whereCondition['ADDRESS1'] = $_GET['address1']; }


if (!empty($_GET['train-route']))
{ $whereCondition['TRAIN_ROUTE'] = $_GET['train-route']; }


if (!empty($_GET['minutes-walking']))
{ $whereCondition['MINUTES_WALKING'] = $_GET['minutes-walking']; }

if (!empty($_GET['building-year'])) {
    if ($_GET['building-year'] == '1') {
        // 新築を選んだ時のみ築年数ではなく新築フラグとして格納
        $whereCondition['NEW_CONSTRUCTION_FLAG'] = $_GET['building-year'];
    } else {
        $whereCondition['BUILDING_YEAR'] = $_GET['building-year'];
    }
}

if (!empty($_GET['free-word'])) {
    $whereCondition['FREE_WORD'] = $_GET['free-word'];
    $whereCondition['AND_OR_SEARCH'] = $_GET['and-or-search'];
}

if (!empty($_GET['free-word-minus']))
{ $whereCondition['FREE_WORD_MINUS'] = $_GET['free-word-minus']; }


if (!empty($_GET['rent-from']) || (!empty($_GET['rent-to'])))
{ $whereCondition['RENT'] = $_GET['rent-from']. ";". $_GET['rent-to'];}


if ((isset($_GET['madori-room']) && is_array($_GET['madori-room']))
    && (isset($_GET['madori-type']) && is_array($_GET['madori-type']))) {
    $floorPlans = [];
    $forCnt = 0;
    foreach ($_GET['madori-room'] as $roomCnt) {
        foreach ($_GET['madori-type'] as $roomType) {
            $floorPlans[$forCnt] = $roomCnt.$roomType;
            $forCnt ++;
        }
    }
    $whereCondition['FLOOR_PLAN'] = $floorPlans;
}

// if (!empty($_GET['floor-plan']))
// { $whereCondition['FLOOR_PLAN'] = $_GET['floor-plan']; }

if (!empty($_GET['building-type']))
{ $whereCondition['BUILDING_TYPE'] = $_GET['building-type']; }

if (!empty($_GET['remarks-2']))
{ $whereCondition['REMARKS_2'] = $_GET['remarks-2']; }

// 並び順 デフォルトはオススメ順
$orderByCondition = 'RECOMMEND_FLAG_DESC';
if (!empty($_GET['order-by-condition']))
{ $orderByCondition = $_GET['order-by-condition']; }

// 表示件数 デフォルトは20
$displayedResultCnt = 20;
if (!empty($_GET['displayed-result-cnt']))
{ $displayedResultCnt = $_GET['displayed-result-cnt']; }

// 現在のページ数 デフォルトは1
$currentPage = 1;
if (!empty($_GET['specified-page']))
{ $currentPage = $_GET['specified-page']; }


// 不整値が含まれていないかバリデート
foreach ($whereCondition as $val) {
    if (is_array($val)) {
        foreach($val as $v) {
            $validateErr = str_validate($v);
            if ($validateErr) {
                echo $validateErr;
                return;
            }
        }
    } else if (is_string($val)){
        $validateErr = str_validate($val);
        if ($validateErr) {
            echo $validateErr;
            return;
        }
    }
}

// 指定された件数分の物件情報を取得する。デフォルトは20件ずつ
$roll = "user";
$DBHandle = new DBHandle();
$issueSql = new IssueSql();
$selectQuery = $issueSql->issueSelectQuery($whereCondition, $orderByCondition, $displayedResultCnt, $currentPage, $roll);
$propertyJson = $DBHandle->selectReturnJson($selectQuery);

// 現在の検索条件での物件数をlimit句を除いて全件取得する
$selectCntQuery = $issueSql->issueSelectQuery($whereCondition, $orderByCondition, null, null, $roll);
$propertiesCnt = $DBHandle->countProperties($selectCntQuery);

