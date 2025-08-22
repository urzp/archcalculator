<?php
push_log('customer.subscription.updated', basename(__FILE__), 'stipe_log'); 
push_log('$event: '.$event, basename(__FILE__), 'stipe_log');
$data_object = $event->data->object;
$stripe_custemer_id = $data_object->customer;
$subscription_id = $data_object->id;
push_log('$data_object: '.$data_object, basename(__FILE__), 'stipe_log');
push_log('$stripe_custemer_id: '.$stripe_custemer_id, basename(__FILE__), 'stipe_log');
push_log('$subscription_id: '.$subscription_id, basename(__FILE__), 'stipe_log');

$subscription = $data_object;
$lastItemIndex = count($subscription['items']['data']) - 1; 
$currentPeriodEnd = $subscription['items']['data'][$lastItemIndex]['current_period_end'];
$currentPeriodEndDate = date('Y-m-d H:i:s', $currentPeriodEnd);

$mysql = $mysql_calc;

$selector = "`stripe_custemer_id`='$stripe_custemer_id'";
$findUser = crud_read('users', 'id' ,$selector)[0]['id'];

if($findUser==''){
    $data_err['event']="customer.subscription.updated";
    $data_err['id_event']=$subscription_id;
    $data_err['comment']="Not find user with reference stripe_custemer_id $stripe_custemer_id new subscription $subscription_id";
    crud_create('errors_stripe', $data_err);
}else{
    $update_data['subscription_period_end']=$currentPeriodEndDate;
    $update_data['stripe_subscription_id']=$subscription_id;
    crud_update('users', $update_data, $selector);
}

push_log('stripe_custemer_id: '.$stripe_custemer_id, basename(__FILE__), 'stipe_log');
push_log('$subscription_id: '.$subscription_id, basename(__FILE__), 'stipe_log');
push_log('$currentPeriodEndDate: '.$currentPeriodEndDate, basename(__FILE__), 'stipe_log');

?>