<?php

$input_data = $rq_data -> data;
$email = $input_data -> email;
$password = md5( $input_data->password );

$data['email']=$email;
$data['password']=$password;
crud_create('users', $data);

$result = (object) [
    'success' => true,
];

?>