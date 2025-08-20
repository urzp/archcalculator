<?php
include $_SERVER['DOCUMENT_ROOT'].'/php/config.php'; $mysql = $mysql_calc;
include $_SERVER['DOCUMENT_ROOT'].'/php/modules/crud.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/php/logs/log.php';
//push_log('------------------begin webhook-----------------------', basename(__FILE__), 'stipe_log');
//push_log(json_encode($_POST), basename(__FILE__), 'stipe_log');


require_once $_SERVER['DOCUMENT_ROOT'].'/php/lib/stripe-php-master/init.php';

// for sandbox
// \Stripe\Stripe::setApiKey('sk_test_51RahmuPtu9HDKCGxVqgDG1i8Wquf4q2bdcSLWxUr8jM1wdrylAq7VJWFPg9CgUHaToladMxr29iVQZmbIzup2BeW00Hz7tZG1x');
// $endpoint_secret = 'whsec_6ywYqQ9NCE1edBaIfHkKMLTLdmubjxix';//'whsec_nSlykMG31kD7YwvOd8tC0asdXrIoxJBE'; 

$setApiKey = crud_read('settings', 'value', "`name`='setApiKey'")[0]["value"];
$signingSecret = crud_read('settings', 'value', "`name`='signingSecret'")[0]["value"];

\Stripe\Stripe::setApiKey($setApiKey);
$endpoint_secret = $signingSecret;

$payload = @file_get_contents('php://input');
$event = null;

try {
  $event = \Stripe\Event::constructFrom(
    json_decode($payload, true)
  );
} catch(\UnexpectedValueException $e) {
  // Invalid payload
  push_log('Webhook error while parsing basic request.', basename(__FILE__), 'stipe_log');
  //echo '⚠️  Webhook error while parsing basic request.';
  http_response_code(400);
  exit_script();
}

//push_log( $event, basename(__FILE__), 'stipe_log');

if ($endpoint_secret) {
  // Only verify the event if there is an endpoint secret defined
  // Otherwise use the basic decoded event
  $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
  try {
    $event = \Stripe\Webhook::constructEvent(
      $payload, $sig_header, $endpoint_secret
    );
  } catch(\Stripe\Exception\SignatureVerificationException $e) {
    // Invalid signature
    push_log('Webhook error while validating signature.', basename(__FILE__), 'stipe_log');
    echo '⚠️  Webhook error while validating signature.';
    http_response_code(400);
    exit_script();
  }
}

// Handle the event
switch ($event->type) {
  case 'checkout.session.completed':
    $paymentMethod = $event->data->object; 
    include '08_stripe/01_session_complited.php';
    break;
  case 'invoice.payment_succeeded':
    $paymentIntent = $event->data->object; 
    include '08_stripe/02_payment_succeeded.php';
    break;
  case 'invoice.payment_failed':
    $paymentIntent = $event->data->object; 
    include '08_stripe/03_payment_failed.php';
    break;
  case 'customer.subscription.updated':
    $paymentIntent = $event->data->object; 
    include '08_stripe/04_subscription_updated.php';
    break;
  case 'customer.subscription.deleted':
    $paymentIntent = $event->data->object; 
    include '08_stripe/05_subscription_deleted.php';
    break;
  default:
    // Unexpected event type
    error_log('Received unknown event type');
    push_log('Received unknown event type: '.$event->type, basename(__FILE__), 'stipe_log');
}

http_response_code(200);
exit_script();


function exit_script(){
  //push_log('------------------begin webhook-------------------------', basename(__FILE__), 'stipe_log');
  exit();
}

?>