<?php

push_log('invoice.payment_failed', basename(__FILE__), 'stipe_log'); 
$data_object = $event->data->object;
$stripe_id = $data_object->id;
$stripe_custemer_id = $data_object->customer;

push_log('$stripe_id'.$stripe_id, basename(__FILE__), 'stipe_log'); 
push_log('$stripe_custemer_id'.$stripe_custemer_id, basename(__FILE__), 'stipe_log'); 

$data_err['event']="invoice.payment_failed";
$data_err['id_event']=$stripe_id;
$data_err['comment']="Payment faled stripe_custemer_id $stripe_custemer_id";
crud_create('errors_stripe', $data_err);
?>