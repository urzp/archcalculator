<?php

//require_once $_SERVER['DOCUMENT_ROOT'].'/php/logs/log.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/php/lib/stripe-php-master/init.php';
$subscriptionId = $rq_data -> subscriptionId;

\Stripe\Stripe::setApiKey(SET_API_KEY);
$endpoint_secret = SIGNIHN_SECRET;

try {
    $subscription = \Stripe\Subscription::retrieve($subscriptionId);
    $subscription->delete();
    $success = true;
    $result = (object) [
        'success' => true,
        '$subscription' => $subscriptionId,
    ];
}catch (\Stripe\Exception\ApiErrorException $e) {
    $success = false;
    $result = (object) [
        'success' => false,
        'Error: ' => $e->getMessage()
    ];
}

if($success){
    $selector = " `id` = '$user_id' AND `token` = '$token' ";
    $update = [];
    $update['stripe_custemer_id']='';
    $update['stripe_subscription_id']='';
    $update_data['stripe_status']='';
    $update['subscription_period_end']='';
    crud_update('users', $update, $selector);
}

?>