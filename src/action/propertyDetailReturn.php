<?php
$where['PROPERTY_ID'] = $_GET['property-id'];
$DBHandle = new DBHandle();
$issueSql = new IssueSql();
$selectQuery = $issueSql->issueSelectQuery($where,null,null,null,"user");
$propertyJson = $DBHandle->selectReturnJson($selectQuery);
