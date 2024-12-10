<?php

$input_data = $rq_data -> data;
$email = $input_data -> email;
$code = $input_data -> code;

$selector = " `email` = '$email' AND `codeConfirm` = '$code' ";
$data = crud_read('users',"email_confirmed", $selector)[0];

if($data == null){ 
    $result = (object) [
        'success' => false,
    ];
}else{ 
    $new_data['email_confirmed']='1';
    crud_update('users', $new_data, $selector);
    $result = (object) [
        'success' => true,
        'data' => $data,
    ];
}


?>