<?php
//https://honorar.online/php/dataServis/08_stripe/test_01.php
include $_SERVER['DOCUMENT_ROOT'].'/php/config.php'; $mysql = $mysql_calc;
include $_SERVER['DOCUMENT_ROOT'].'/php/modules/crud.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/php/logs/log.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/php/lib/stripe-php-master/init.php';

echo $setApiKey.'</br>';

\Stripe\Stripe::setApiKey(SET_API_KEY);
$endpoint_secret = SIGNIHN_SECRET;

$subscriptionId = 'sub_1RxpKeL724uNY9UuDm5MMklk';

try {
    $subscription = \Stripe\Subscription::retrieve($subscriptionId);
    $subscription->delete();
    echo "<pre>";
    echo "Подписка с ID {$subscriptionId} успешно удалена.";
    echo "</pre>";
} catch (\Stripe\Exception\ApiErrorException $e) {
    echo 'Error: ' . $e->getMessage();
}

?>