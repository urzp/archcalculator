<?php
//https://honorar.online/php/dataServis/08_stripe/test_01.php
include $_SERVER['DOCUMENT_ROOT'].'/php/config.php'; $mysql = $mysql_calc;
include $_SERVER['DOCUMENT_ROOT'].'/php/modules/crud.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/php/logs/log.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/php/lib/stripe-php-master/init.php';

$setApiKey = crud_read('settings', 'value', "`name`='setApiKey'")[0]["value"];
$signingSecret = crud_read('settings', 'value', "`name`='signingSecret'")[0]["value"];

echo $setApiKey.'</br>';

\Stripe\Stripe::setApiKey($setApiKey);
$endpoint_secret = $signingSecret;

$subscriptionId = 'sub_1RxpKeL724uNY9UuDm5MMklk';

try {
    $subscription = \Stripe\Subscription::retrieve($subscriptionId);
    
    echo "<pre>";
    print_r($subscription);
    echo "</pre>";
} catch (\Stripe\Exception\ApiErrorException $e) {
    echo 'Error: ' . $e->getMessage();
}

?>