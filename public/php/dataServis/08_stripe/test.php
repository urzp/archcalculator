<?php
include $_SERVER['DOCUMENT_ROOT'].'/php/config.php';
include $_SERVER['DOCUMENT_ROOT'].'/php/modules/crud.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/php/logs/log.php';

echo 'begin <br>';
$mysql = $mysql_calc;

    $mysql = $mysql_calc;

    $stripe_custemer_id = 'cus_SZ19OYm01k6k2I';
    $currentPeriodEndDate = "2025-06-26 18:00:00";
    $stripe_id = 'in_1Re9CmPtu9HDKCGxKhIfuaE3';

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
    





?>