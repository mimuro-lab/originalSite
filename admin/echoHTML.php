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

?>