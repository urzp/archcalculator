<?php

$email = $rq_data -> email;
$email= $mysql->real_escape_string($email);
$selector = " `email` = '$email' ";
$data = crud_read('users',"*", $selector)[0];

if($data == null){ $success = true; }else{ $success = false; }

$result = (object) [
    'success' => $success,
];