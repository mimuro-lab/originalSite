<?php
require(".//..//check.php");
require(".//save_file.php");

function echoInputForm(int $index_post){
  require(".//form_post.php");
  echo "投稿indexは" . $index_post . "です。<br>※更新時に変化する可能性があります。投稿直後に確定します。";
}

function echoPreview(){
  if(isset($_POST["title"]) && isset($_POST["tag"]) && isset($_POST["body"])){
    echo "<br>プレビュー<br>※タグは表示されません。<br>";
    echo "<table border=1><tr><td>タイトル</td><td>";
    echo $_POST["title"];
    echo "</td></tr><tr><td>タグ</td><td>";
    echo $_POST["tag"];
    echo "</td></tr></table><br><table border=1><tr><td>本文</td><tr><td>";
    echo $_POST["body"];
    echo "</td></tr></table>";
    // 戻るボタン
    echo '<form method="POST" action=".?scene=input"> ';
    echo '<input type="hidden" name="title" value='.$_POST["title"].">";
    echo '<input type="hidden" name="tag" value='.$_POST["tag"].">";
    echo '<input type="hidden" name="body" value='.$_POST["body"].">";
    echo '<input type="submit" value="入力画面へ戻る"> </form>';
    // 投稿ボタン
    echo '<form method="POST" action=".?scene=save"> ';
    echo '<input type="hidden" name="title" value='.$_POST["title"].">";
    echo '<input type="hidden" name="tag" value='.$_POST["tag"].">";
    echo '<input type="hidden" name="body" value='.$_POST["body"].">";
    echo '<input type="submit" value="投稿する"> </form>';
  }
}

?>
<!DOCTYPE html>
<html>
  <head>
    <title>タイトル　編集画面</title>
  </head>
  <body>
    <?php
    if(isset($_COOKIE["username"]) && isset($_COOKIE["password"]) && isset($_GET["scene"]) 
    && check_userInfo($_COOKIE["username"], $_COOKIE["password"])){
      echo $_COOKIE["username"] . "さんの投稿<br>";
      if($_GET["scene"] == "input"){
        echoInputForm($index_post);
      }else if($_GET["scene"] == "preview"){
        echoPreview();
      }else if($_GET["scene"] == "save"){
        save_post($_POST["title"], $_POST["tag"], $_POST["body"], (string)$index_post);
      }
      
    }
    else{
        echo "ユーザー情報が入力されていません。";
    }
    ?>
  </body>
</html>