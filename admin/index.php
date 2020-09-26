
<?php
require(".\\check.php");
require(".\\echoHTML.php");
?>

<!DOCTYPE html>
<html>
  <head>
    <title>タイトル　管理ページ</title>
  </head>
  <body>
  <!-- ユーザー情報入力用フォーム -->
  <form action="" method="get">
  <div>
    <label for="username">ユーザー名</label>
    <input type="text" id="username" name="username">
  </div>
  <div>
    <label for="password">パスワード</label>
    <input type="text" id="password" name="password">
  </div>
  <input type="submit" value="送信する">
  </form>
  <!-- ユーザー情報入力用フォーム -->

  <!-- 入力後の画面表示 -->
  <?php 
  //ユーザー情報が入力されていたら。
  if(isset($_GET["username"]) && isset($_GET["password"])){
    $username = $_GET["username"];
    $password = $_GET["password"];
    if(check_userInfo($username, $password)){
      echoSuccessPage();
    }
  }

  ?>
  <!-- 入力後の画面表示 -->

  </body>
</html>