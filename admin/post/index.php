<!DOCTYPE html>
<html>
  <head>
    <title>タイトル　編集画面</title>
  </head>
  <body>
    <?php
    if(isset($_COOKIE["username"]) && isset($_COOKIE["password"])){
        echo $_COOKIE["username"] . ":" . $_COOKIE["password"] . "<br>";
    }
    else{
        echo "ユーザー情報が入力されていません。";
    }
    ?>
  </body>
</html>