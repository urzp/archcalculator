<?php

$input_data = $rq_data -> data;
$email = $input_data -> email;
$password = md5( $input_data->password );

$selector = " `email` = '$email' AND `password` = '$password' ";
$data = crud_read('users',"*", $selector)[0];

if($data == null){
    $success = false;
}else{
    $success = true;
    unset($data['password']);
    $token = gen_token();
    $data['token'] = $token;
    $new_data['token'] = $token;
    crud_update('users', $new_data, $selector);
}

$result = (object) [
    'success' => $success,
    'data' => $data,
];

function gen_token() {
	$bytes = openssl_random_pseudo_bytes(20, $cstrong);
	return bin2hex($bytes); 
}

?>