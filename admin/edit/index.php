<?php
require(".//..//check.php");
require(".//save_file.php");
require(".//echoPreview.php");

define("path_to_data", ".\\..\\..\\database\\");

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

function echoEditPreview(){
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
      echo '<input type="hidden" name="index" value='.$_POST["index"].">";
      echo '<input type="hidden" name="title" value='.$_POST["title"].">";
      echo '<input type="hidden" name="tag" value='.$_POST["tag"].">";
      echo '<input type="hidden" name="body" value='.$_POST["body"].">";
      echo '<input type="submit" value="入力画面へ戻る"> </form>';
      // 投稿ボタン
      echo '<form method="POST" action=".?scene=save"> ';
      echo '<input type="hidden" name="index" value='.$_POST["index"].">";
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
        if(isset($_POST["index"])){
            
            if(exitIndex(preg_replace('/[^0-9]/', '', $_POST["index"]))){
                $pathToPost = ".\\..\\..\\database\\".preg_replace('/[^0-9]/', '', $_POST["index"])."\\index.html";
                echo '<table border=0><tr><td>';
                echoPreview($pathToPost);
                echo '</td><td>';   
                require(".//form_edit.php");
                echo '</td></tr></table>';

            }else{
                require(".\\cannot_find.php");
            }
        }

      }else if($_GET["scene"] == "preview"){
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