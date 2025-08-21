<?php

    $code = generatePinCode(8);

    $selector = "`id`='$user_id'";
    $new_data['stripe_client_secret']=$code;
    crud_update('users', $new_data, $selector);

    $result = (object) [
        'success' => $result,
        'data' => $code,
    ];


?>