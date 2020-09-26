
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

  <!-- メイン処理-->
  <?php
  //どちらかが入力されていなかったら 
  if(!isset($_POST["username"]) || !isset($_POST["password"])){
    echoRoginPage();
  }
  //ユーザー情報が入力されていたら。
  else if(isset($_POST["username"]) && isset($_POST["password"])){
    $username = $_POST["username"];
    $password = $_POST["password"];
    if(check_userInfo($username, $password)){//認証が成功したら
      $effectiveTime = time() + 60 * 60 * 3;//有効期限は3時間
      setcookie("username", $username, $effectiveTime);
      setcookie("password", $password, $effectiveTime);
      echoSuccessPage();
    }else{//認証に失敗したら
      echoFailedPage();
    }
  }

  ?>
  <!-- メイン処理 -->

  </body>
</html>