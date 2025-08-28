<?php

$selector = " `id` = '$user_id' AND `token` = '$token' ";
$data = crud_read('users',"*", $selector)[0];

if($data == null){ 
    $result = (object) [
        'success' => false,
    ];
}else{ 
    if($data['level']=='admin'){$admin=true;}else{$admin=false;}
    if($data['subscription_period_end']>date('Y-m-d H:i:s')){$isTariffActive=true;}else{$isTariffActive=false;}
    $result = (object) [
        'success' => true,
        'isAdmin' => $admin,
        'isTariffActive' => $isTariffActive,
        'tariffStatus' => $data['stripe_status']
    ];
}



?>