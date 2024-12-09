<?php

include 'sendEmails.php';

$input_data = $rq_data -> data;
$email = $input_data -> email;
$code = $input_data -> code;
$password = md5( $input_data->password );

$email= $mysql->real_escape_string($email);
$selector = " `email` = '$email'";
$data = crud_read('users',"*", $selector)[0];

$result = false;
if($data!=null){

    if($code==null){
        $code=GeneratePinCode(5);
        $new_data['resetCode'] = $code;
        crud_update('users', $new_data, $selector);
        sendResetPasswordEmail($email, $code );
        $result = true;
    }else{
        if($code==$data['resetCode']){
            $new_data['password']=$password;
            $new_data['resetCode']="";
            crud_update('users', $new_data, $selector);
            $result = true;
        }else{
            $result = false;
        }
    }

}


$result = (object) [
    'success' => $result,
];

function GeneratePinCode($chars) {
    $pin = "";
    while ($chars != 0) {
        $pin .= rand(0,9);
        $chars--;
    }
    return $pin;
}

?>