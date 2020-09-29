<?php

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

// 記事のindexを求める。
$index_post = -1;
// もし、データベースに何もなかったら
if(empty($exsitDatas)){
    $index_post = 0;
}else{
    $max = -1;
    foreach($exsitDatas as $data){
        $nowInd = (int)$data;
        if($max < $data){
            $max = $data;
        }
    }
    $index_post = $max + 1;
}

function save_post(string $title, string $tag, string $body, string $index_post){
    // ?newl?を改行にする。
    $body = str_replace("?newl?", "<br>", $body);
    // 領域（フォルダ）を作る
    $path = path_to_data."\\".$index_post;
    mkdir($path, 0777);
    // index.htmlを作る
    $pathToHTML = $path . "\\index.html";
    $fp = fopen($pathToHTML, "w");
    fwrite($fp, "<h1>".$title."</h1>\n");
    fwrite($fp, "<div hidden>".$tag."</div>\n");
    fwrite($fp, $body);
    fclose($fp);
    echo "投稿しました。インデックスは".$index_post."です。";
    // アカウントページへ戻る
    echo '<form action=".//..//..//.."><input type="submit" value="アカウントページへ戻る"></form>';
}



?>