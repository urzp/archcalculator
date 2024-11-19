<?php

$input_data = $rq_data -> data;
$email = $input_data -> email;
$code = $input_data -> code;
$password = md5( $input_data->password );

$selector = " `email` = '$email'";
$data = crud_read('users',"*", $selector)[0];

if($data!=null){

    if($code==null){
        $code=GeneratePinCode(5);
        $new_data['resetCode'] = $code;
        crud_update('users', $new_data, $selector);
    }else{
        

    }

}


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