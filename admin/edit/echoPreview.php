<?php

function getPreview($pathToPost){
    $fp = fopen($pathToPost, "r");
    $title = str_replace("</h1>","",str_replace("<h1>", "",fgets($fp)));
    $tag = str_replace("</div>","",str_replace("<div hidden>", "",fgets($fp)));
    $body = fgets($fp);
    fclose($fp);
    return array($title,$tag,$body);
}

function echoPreview($pathToPost){
    $fp = fopen($pathToPost, "r");
    $title = str_replace("</h1>","",str_replace("<h1>", "",fgets($fp)));
    $tag = str_replace("</div>","",str_replace("<div hidden>", "",fgets($fp)));
    $body = fgets($fp);
    fclose($fp);
    
    echo '<table border=1><tr><td>タイトル</td><td>'.$title.'</td></tr><td>タグ</td><td>'.$tag.'</td></table>';
    echo '<table border=1><tr><td>本文</td></tr><tr><td>'.$body.'</td></tr><tr></td></table>';

}

?>