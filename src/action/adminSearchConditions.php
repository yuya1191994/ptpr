<?php
$whereCondition = [];
if (!empty($_GET['property-id']))
{ $whereCondition['PROPERTY_ID'] = $_GET['property-id']; }

if (!empty($_GET['ad-flag']))
{ $whereCondition['AD_FLAG'] = $_GET['ad-flag']; }

if (!empty($_GET['release-flag']))
{ $whereCondition['RELEASE_FLAG'] = $_GET['release-flag']; }

if (!empty($_GET['room-photo']))
{ $whereCondition['ROOM_PHOTO'] = $_GET['room-photo']; }

if (!empty($_GET['new-arrival-flag']))
{ $whereCondition['NEW_ARRIVAL_FLAG'] = $_GET['new-arrival-flag']; }

$orderByCondition = '';
if (!empty($_GET['order-by-condition']))
{ $orderByCondition = $_GET['order-by-condition']; }

$DBHandle = new DBHandle();

// 表示件数 デフォルトは20
$displayedResultCnt = 20;
if (!empty($_GET['displayed-result-cnt']))
{ $displayedResultCnt = $_GET['displayed-result-cnt']; }

// 現在のページ数 デフォルトは1
$currentPage = 1;
if (!empty($_GET['specified-page']))
{ $currentPage = $_GET['specified-page']; }

// 指定された件数分の物件情報を取得する。デフォルトは20件ずつ
$issueSql = new IssueSql();
$roll = "admin";
$selectQuery = $issueSql->issueSelectQuery($whereCondition, $orderByCondition, $displayedResultCnt, $currentPage, $roll);
$propertyJson = $DBHandle->selectReturnJson($selectQuery);

// 現在の検索条件での物件数をlimit句を除いて全件取得する
$selectCntQuery = $issueSql->issueSelectQuery($whereCondition, $orderByCondition, null, null, $roll);
$propertiesCnt = $DBHandle->countProperties($selectCntQuery);
