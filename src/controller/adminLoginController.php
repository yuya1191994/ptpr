<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . "/ptpr-dev/src/service/issueSql.php");
require_once ($_SERVER['DOCUMENT_ROOT'] . "/ptpr-dev/src/action/DBHandle.php");

// 入力されたidとパスワードを取得
$wheres = [];
$wheres['login-id'] = $_POST['login-id'];
$wheres['login-password'] = $_POST['login-password'];

// sqlを生成
$issueSql = new issueSql();
$loginSql_noBind = $issueSql->issueAdminLoginQuery();

// sqlを実行。合致すれば1を、合致しなければ0を返す
$DBHandle = new DBHandle();
$exist = $DBHandle->adminLogin($loginSql_noBind, $wheres);

if ($exist == 1) {
    if (session_start() == true) {
        // ログインセッションを作成し管理画面へ遷移
        $_SESSION['login'] = 'true';
        http_response_code(301);
        header("Location: /ptpr-dev/src/admin.php");
        exit();
    }
} else {
    // ログイン画面へリダイレクト
    http_response_code(301);
    header("Location: /ptpr-dev/src/admin-login.php");
    exit();
}

?>