<?php
    push_log('payment_intent.succeeded', basename(__FILE__), 'stipe_log');  
    $data_object = $event->data->object;
    $stripe_custemer_id = $data_object->customer;

    push_log('stripe_custemer_id: '.$stripe_custemer_id, basename(__FILE__), 'stipe_log');
?>