<?php

$selector = " `id` = '$user_id' AND `token` = '$token' ";
$data = crud_read('users',"*", $selector)[0];

if($data == null){ 
    $result = (object) [
        'success' => false,
    ];
}else{ 
    if($data['level']=='admin'){$admin=true;}else{$admin=false;}
    $result = (object) [
        'success' => true,
        'isAdmin' => $admin,
    ];
}



?>