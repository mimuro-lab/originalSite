<?php

// 認証に成功した時のページ表示
function echoSuccessPage(){
    $fp = fopen(".\\success.html", "r");
    $contentOfAll = "";
    while($content = fgets($fp)){
        $contentOfAll .= $content;
    }
    echo $contentOfAll;
}

// 認証に失敗した時のページ表示
function echoFailedPage(){
    $fp = fopen(".\\failed.html", "r");
    $contentOfAll = "";
    while($content = fgets($fp)){
        $contentOfAll .= $content;
    }
    echo $contentOfAll;
}

?>