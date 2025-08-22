<?php
    push_log('invoice.payment_succeeded', basename(__FILE__), 'stipe_log');  
    $data_object = $event->data->object;
    $stripe_id = $data_object->id;
    $stripe_custemer_id = $data_object->customer;
    $currentPeriodEndDate = $data_object->period_end;
    $currentPeriodEndDate = date('Y-m-d H:i:s', $currentPeriodEndDate);

    $mysql = $mysql_calc;

    $selector = "`stripe_custemer_id`='$stripe_custemer_id'";
    $findUser = crud_read('users', 'id' ,$selector)[0]['id'];
    if($findUser==''){
        echo  'null';
        $data_err['event']="invoice.payment_succeeded";
        $data_err['id_event']=$stripe_id;
        $data_err['comment']="Not find user with reference stripe_custemer_id $stripe_custemer_id";
        crud_create('errors_stripe', $data_err);
    }else{
        $update_data['subscription_period_end']=$currentPeriodEndDate;
        crud_update('users', $update_data, $selector);
    }

    push_log('stripe_custemer_id: '.$stripe_custemer_id, basename(__FILE__), 'stipe_log');
    push_log('currentPeriodEndDate: '.$currentPeriodEndDate, basename(__FILE__), 'stipe_log');
?>