<?php
require(".//..//check.php");
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
            if(exitIndex($_POST["index"])){
                $pathToPost = ".\\..\\..\\database\\".$_POST["index"]."\\index.html";
                echoPreview($pathToPost);
            }else{
                require(".\\cannot_find.php");
            }
        }

      }else if($_GET["scene"] == "save"){
      }
      
    }
    else{
        echo "ユーザー情報が入力されていません。";
    }
    ?>
  </body>
</html>