<?php
require(".//..//check.php");
require(".//save_file.php");
require(".//form_post.php");

function escapeChars(){
  $_POST["body"] = str_replace("\r\n", "?newl?", $_POST["body"]);
  $_POST["body"] = htmlspecialchars($_POST["body"]);
}

function getDisplayBody(){
  $displayStr = str_replace("?newl?", "</td></tr><tr><td>", $_POST["body"]);
  //空白行を入れる
  $displayStr = str_replace("<td></td>", "<td><br></td>", $displayStr);
  return $displayStr;
}

function getDisplayTitle(){
  return $_POST["title"];
}

function getDisplayTag(){
  return $_POST["tag"];
}

function getPreInputBody(){
  return str_replace("?newl?", "\r\n", $_POST["body"]);
}

function getPreInputTitle(){
  return $_POST["title"];
}

function getPreInputTag(){
  return $_POST["tag"];
}

function echoInputForm(int $index_post){
  echoFormPost(getPreInputTitle(), getPreInputTag(), getPreInputBody());
  //echoFormPost("タイトル", "タグ", "本文");
  echo "投稿indexは" . $index_post . "です。<br>※更新時に変化する可能性があります。投稿直後に確定します。";
}

function echoPreview(string $title, string $tag, string $body){
  if(isset($title) && isset($tag) && isset($body)){
    // フォームの出力
    echo '
    <br>プレビュー<br>
    ※タグは表示されません。<br>
    <table border=0>
      <tr>
        <td>タイトル</td>
        <td>'.$title.'</td>
      </tr>
      <tr>
        <td>タグ</td>
        <td>'.$tag.'
      </tr>
    </table>
    <br>
    <table border=0>
      <tr>
        <td>本文</td>
      <tr>
        <td>'.$body.'</td>
      </tr>
    </table>
    ';

    // 戻るボタン
    echo '
    <form method="POST" action=".?scene=input"> 
    <input type="hidden" name="title" value='.$_POST["title"].'>
    <input type="hidden" name="tag" value='.$_POST["tag"].'>
    <input type="hidden" name="body" value='.$_POST["body"].'>
    <input type="submit" value="入力画面へ戻る"> </form>
    ';

    // 投稿ボタン
    echo '<form method="POST" action=".?scene=save">
    <input type="hidden" name="title" value='.$_POST["title"].'>
    <input type="hidden" name="tag" value='.$_POST["tag"].'>
    <input type="hidden" name="body" value='.$_POST["body"].'>
    <input type="submit" value="投稿する"> </form>';
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
        escapeChars();
        echoPreview(getDisplayTitle(), getDisplayTag(), getDisplayBody());
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