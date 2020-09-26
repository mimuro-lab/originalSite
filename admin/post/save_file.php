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

function save_post(string $title, string $tag, string $body){
    echo $title . $tag . $body;
}



?>