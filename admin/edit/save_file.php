<?php

function save_post(string $title, string $tag, string $body, string $index_post){
    // 領域（フォルダ）を作る
    $path = path_to_data."\\".$index_post;
    $pathToHTML = $path . "\\index.html";
    $fp = fopen($pathToHTML, "w");
    fwrite($fp, "<h1>".$title."</h1>\n");
    fwrite($fp, "<div hidden>".$tag."</div>\n");
    fwrite($fp, $body);
    fclose($fp);
    echo "投稿しました。インデックスは".$index_post."です。";
}

?>