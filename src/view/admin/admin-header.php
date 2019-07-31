<?php
if (session_start() == true) {
    if ($_SESSION['login'] != 'true') {
        http_response_code(301);
        header("Location: /ptpr-dev/src/admin-login.php");
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>プチプラちんたい　管理画面</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="物件管理画面">
<meta name=”robots” content=”noindex”>
<meta name=”robots” content=”nofollow”>
<link rel="stylesheet" href="../assets/css/admin.css">
<link rel="stylesheet" href="../assets/css/slide.css">
<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/openclose.js"></script>
<script src="../assets/js/fixmenu.js"></script>
<script src="../assets/js/fixmenu_pagetop.js"></script>
<script src="../assets/js/admin.js"></script>
<script src="../assets/js/jquery-ui.min.js"></script>
</head>

