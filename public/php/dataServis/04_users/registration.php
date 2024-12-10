<?php
include 'sendEmails.php';

$input_data = $rq_data -> data;
$email = $input_data -> email;
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

function GeneratePinCode($chars) {
    $pin = "";
    while ($chars != 0) {
        $pin .= rand(0,9);
        $chars--;
    }
    return $pin;
}

?>