<?php
require(".//..//check.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <title>タイトル　編集画面</title>
  </head>
  <body>
    <?php
    if(isset($_COOKIE["username"]) && isset($_COOKIE["password"])){
        if(check_userInfo($_COOKIE["username"], $_COOKIE["password"])){
          echo $_COOKIE["username"] . "さんの投稿<br>";
          require(".//form_post.html");
        }
    }
    else{
        echo "ユーザー情報が入力されていません。";
    }
    ?>
  </body>
</html>