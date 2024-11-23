<?php
$input_data = $rq_data -> data;

$oldPassword = $input_data -> oldPassword;
$newPassword = $input_data -> newPassword;

$oldPassword = md5( $oldPassword );
$newPassword = md5( $newPassword );

$selector = " `id` = '$user_id' AND `token` = '$token' ";

$data = crud_read('users',"*", $selector)[0];

$success = false;

if($data == null||$data['password']!=$oldPassword){
    $success = false;
}else{
    $new_data['password']=$newPassword;
    crud_update('users', $new_data, $selector);
    $success = true;
}

$result = (object) [
    'success' => $success,
];   

?>