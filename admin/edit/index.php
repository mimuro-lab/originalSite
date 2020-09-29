<?php
require(".//..//check.php");
require(".//save_file.php");
require(".//echoPreview.php");
require(".//form_edit.php");

define("path_to_data", ".\\..\\..\\database\\");

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

function getPreInputBody(){
  return str_replace("?newl?", "\r\n", $_POST["body"]);
}

// 現在の投稿の全てを格納する。
$exsitDatas = scandir(path_to_data);
$exsitDatas_tmp = array();
foreach($exsitDatas as $data){
    if($data != "." && $data != ".."){
        array_push($exsitDatas_tmp, $data);
    }
}
$exsitDatas = $exsitDatas_tmp;

// 対象のインデックスが存在するかどうかを確かめる関数
function exitIndex($index){
    global $exsitDatas;
    foreach($exsitDatas as $ind){
        if($index == $ind){
            return true;
        }
    }
    return false;
}


function echoPreview_(string $title, string $tag, string $body){
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


function echoEditPreview(){
    if(isset($_POST["title"]) && isset($_POST["tag"]) && isset($_POST["body"])){

      echo "<br>プレビュー<br>※タグは表示されません。<br>";
      echo "<table border=1><tr><td>タイトル</td><td>";
      echo $_POST["title"];
      echo "</td></tr><tr><td>タグ</td><td>";
      echo $_POST["tag"];
      echo "</td></tr></table><br><table border=1><tr><td>本文</td><tr><td>";
      echo getDisplayBody();
      echo "</td></tr></table>";
      // 戻るボタン
      echo '<form method="POST" action=".?scene=input"> ';
      echo '<input type="hidden" name="index" value='.$_COOKIE["index"].">";
      echo '<input type="hidden" name="title" value='.$_POST["title"].">";
      echo '<input type="hidden" name="tag" value='.$_POST["tag"].">";
      echo '<input type="hidden" name="body" value='.$_POST["body"].">";
      echo '<input type="submit" value="入力画面へ戻る"> </form>';
      // 投稿ボタン
      echo '<form method="POST" action=".?scene=save"> ';
      echo '<input type="hidden" name="index" value='.$_COOKIE["index"].">";
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
      if($_GET["scene"] == "input_index"){
        require(".//form_index.php");
      }else if($_GET["scene"] == "input"){
        setcookie("index", $_POST["index"], time() + 60 * 10);
        print_r($_COOKIE);
        if(isset($_COOKIE["index"])){
            
            if(exitIndex(preg_replace('/[^0-9]/', '', $_COOKIE["index"]))){
              $pathToPost = ".\\..\\..\\database\\".preg_replace('/[^0-9]/', '', $_POST["index"])."\\index.html";
              if(!isset($_POST["title"])){
                $_POST["title"] = getPreview($pathToPost)[0];
              }  
              if(!isset($_POST["tag"])){
                $_POST["tag"] = getPreview($pathToPost)[1];
              }
              if(!isset($_POST["body"])){
                $_POST["body"] = getPreview($pathToPost)[2];
                $_POST["body"] = str_replace("<br>", "\r\n", $_POST["body"]);
              }
              
              echo '<table border=0><tr><td>';
              echoPreview($pathToPost);
              echo '</td><td>';   
              echoFormEdit($_POST["title"], $_POST["tag"], getPreInputBody());
              echo '</td></tr></table>';

            }else{
                require(".\\cannot_find.php");
            }
        }

      }else if($_GET["scene"] == "preview"){
        print_r($_POST);
        print_r($_COOKIE);
        escapeChars();
        echoEditPreview();
      }else if($_GET["scene"] == "save"){
        save_post($_POST["title"], $_POST["tag"], $_POST["body"], preg_replace('/[^0-9]/', '', $_POST["index"]));
      }
      
    }
    else{
        echo "ユーザー情報が入力されていません。";
    }
    ?>
  </body>
</html>