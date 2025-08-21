<?php

$input_data = $rq_data -> data;
$email = $input_data -> email;

$selector = " `email` = '$email'";
$checkEmail = crud_read('users',"*", $selector)[0];

if($checkEmail == null && isValidEmail($email)){ 

    include 'sendEmails.php';

    $password = md5( $input_data->password );
    $emailComfirmecode = GeneratePinCode(5);

    $data['email']=$email;
    $data['password']=$password;
    $data['codeConfirm']=$emailComfirmecode;

    crud_create('users', $data);
    sendRegistrationEmail($email, $input_data->password, $emailComfirmecode);
    $result = (object) [
        'success' => true,
    ];

}else{
    $result = (object) [
        'success' => false,
    ];
}

function isValidEmail($email){
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

?>