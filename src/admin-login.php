<html>
<head>
<link rel="stylesheet" type="text/css" href="../assets/css/admin-login.css">
<script src="../assets/js/jquery.min.js"></script>
</head>
<body>
  <div class="form-wrapper">
    <h1>物件管理ログイン</h1>
    <form action="controller/adminLoginController.php" method="POST">
      <div class="form-item">
        <input type="text" name="login-id" required="required" placeholder="ログインID"></input>
      </div>
      <div class="form-item">
        <input type="password" name="login-password" required="required" placeholder="パスワード"></input>
      </div>
      <div class="button-panel">
        <input type="submit" id="submit" class="button" value="ログイン"></input>
      </div>
    </form>
    <div class="form-footer"></div>
  </div>
</body>
</html>