<?php
    push_log('checkout.session.completed', basename(__FILE__), 'stipe_log');
    $data_object = $event->data->object;
    $stripe_custemer_id = $data_object->customer;
    $get_client_reference_id = explode('_', $data_object->client_reference_id);
    $client_reference_id = $get_client_reference_id[0];
    $client_secret = $get_client_reference_id[1];
    $subscription_id = $data_object->subscription;
    

    $mysql = $mysql_calc;
    $selector = "id=$client_reference_id";
    $check_client_secret = crud_read('users','stripe_client_secret', $selector)[0];
    $check_client_secret = $check_client_secret['stripe_client_secret'];

    if($check_client_secret!=''){
        push_log(  'secret key is not null', basename(__FILE__), 'stipe_log');
        push_log(  '$check_client_secret'.$check_client_secret, basename(__FILE__), 'stipe_log');
        if($check_client_secret==$client_secret){
            $subscription = \Stripe\Subscription::retrieve($subscription_id);
            $lastItemIndex = count($subscription['items']['data']) - 1; 
            $currentPeriodEnd = $subscription['items']['data'][$lastItemIndex]['current_period_end'];
            $currentPeriodEndDate = date('Y-m-d H:i:s', $currentPeriodEnd);

            $update_data['stripe_custemer_id']=$stripe_custemer_id;
            $update_data['stripe_subscription_id']=$subscription_id;
            $update_data['subscription_period_end']=$currentPeriodEndDate;
        }else{
            push_log( 'secret key is not valid', basename(__FILE__), 'stipe_log');
        }
    }else{
        push_log('secret key is null', basename(__FILE__), 'stipe_log');
    }

    $update_data['stripe_client_secret']='';
    crud_update('users', $update_data, $selector);
    
    push_log('stripe_custemer_id: '.$stripe_custemer_id, basename(__FILE__), 'stipe_log');
    push_log('client_reference_id: '.$client_reference_id, basename(__FILE__), 'stipe_log');
    push_log('client_secret: '.$client_secret, basename(__FILE__), 'stipe_log');
    push_log('subscription_id: '.$subscription_id, basename(__FILE__), 'stipe_log');
?>