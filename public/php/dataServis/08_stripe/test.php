<?php
include $_SERVER['DOCUMENT_ROOT'].'/php/config.php';
include $_SERVER['DOCUMENT_ROOT'].'/php/modules/crud.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/php/logs/log.php';

echo 'begin <br>';
$mysql = $mysql_calc;

// $stripe_custemer_id = 'cus_SYw3x3z3Cz1B9m';
// $client_reference_id= '2';
// $subscription = "sub_1Rd94pPtu9HDKCGxcecv0F5o";
// $client_secret = 'tt34rafe78ure';

require_once $_SERVER['DOCUMENT_ROOT'].'/php/lib/stripe-php-master/init.php';

\Stripe\Stripe::setApiKey('sk_test_51RahmuPtu9HDKCGxVqgDG1i8Wquf4q2bdcSLWxUr8jM1wdrylAq7VJWFPg9CgUHaToladMxr29iVQZmbIzup2BeW00Hz7tZG1x');
$subscriptionId = 'sub_1RdoBgPtu9HDKCGxwZ5FVDzh';

try {
    $subscription = \Stripe\Subscription::retrieve($subscriptionId);
    $lastItemIndex = count($subscription['items']['data']) - 1; 
    $currentPeriodEnd = $subscription['items']['data'][$lastItemIndex]['current_period_end'];
    $currentPeriodEndDate = date('Y-m-d H:i:s', $currentPeriodEnd);

    echo "Current period ends at: " . $currentPeriodEndDate;
} catch (\Stripe\Exception\ApiErrorException $e) {
    // Обработка ошибок
    echo 'Error retrieving subscription: ' . $e->getMessage();
}




?>