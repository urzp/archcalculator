<?php

$isLogin = false;
$isAdmin = false;

$temp = $mysql;
$mysql = $mysql_calc;

$selector = " `id` = '$user_id' AND `token` = '$token' ";
$user = crud_read('users',"*", $selector)[0];

$mysql = $temp;

if($user != null){ 
    $isLogin = true;
    if($user['level']=='admin') $isAdmin = true;
}



?>