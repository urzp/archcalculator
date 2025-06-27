<?php

    push_log('customer.subscription.deleted', basename(__FILE__), 'stipe_log');
    $data_object = $event->data->object;
    $event_id = $data_object->id;
    $stripe_custemer_id = $data_object->customer;

    $mysql = $mysql_calc;
    $selector = "`stripe_custemer_id`='$stripe_custemer_id'";
    $findUser = crud_read('users', 'id' ,$selector)[0]['id'];

    if($findUser==''){
        $data_err['event']="customer.subscription.deleted";
        $data_err['id_event']=$event_id;
        $data_err['comment']="Not find user with reference stripe_custemer_id $stripe_custemer_id ";
        crud_create('errors_stripe', $data_err);
    }else{
        $update_data['stripe_custemer_id']='';
        $update_data['stripe_subscription_id']='';
        $update_data['subscription_period_end']='';
        $update_data['stripe_client_secret']='';
        crud_update('users', $update_data, $selector);
    }

    push_log('stripe_custemer_id: '.$stripe_custemer_id, basename(__FILE__), 'stipe_log');


?>