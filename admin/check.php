<?php

function check_userInfo(string $username, string $passward){
    $fp = fopen(__DIR__."\\admin.csv", "r");
    while($content = fgets($fp)){
        if(count(explode(",",$content))!=2){
            continue;
        }
        $admin_username = explode(",", $content)[0];
        $admin_username = preg_replace('/[\x00-\x1F\x7F]/','', $admin_username);//制御文字の削除
        $admin_password = explode(",", $content)[1];
        $admin_password = preg_replace('/[\x00-\x1F\x7F]/','', $admin_password);//制御文字の削除
        if($username == $admin_username && $passward == $admin_password){
            fclose($fp);
            return true;
        }
    }
    return false;
    fclose($fp);
}

?>