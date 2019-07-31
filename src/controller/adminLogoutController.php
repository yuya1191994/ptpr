<?php

$_SESSION = array();
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
              $params["path"], $params["domain"],$params["secure"], $params["httponly"]
    );
}


if (session_start()) {
    $result = session_destroy();

    if ($result) {
        echo "ログアウトしました。<br>3秒後にログイン画面へ遷移します。";
        echo '<script>setTimeout("location.href=\'/ptpr-dev/src/admin-login.php\'",1000*3);</script>';
    } else {
        echo "ログアウトに失敗しました。";
    }
}