<?php
$updated = $rq_data -> data;
$selector = " `id` = '$user_id' AND `token` = '$token' ";
$data = crud_read('users',"*", $selector)[0];
unset($data['password']);
unset($data['resetCode']);

if($data == null){ 
    $result = (object) [
        'success' => false,
    ];
}else{ 
    if($data['updated'] != $updated){
        $result = (object) [
            'success' => true,
            'data' => $data,
        ];
    }else{
        $result = (object) [
            'success' => false,
        ];
    }
}

?>