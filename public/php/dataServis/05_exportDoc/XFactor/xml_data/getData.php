<?php

include $_SERVER['DOCUMENT_ROOT'].'/php/config.php';
include $_SERVER['DOCUMENT_ROOT'].'/php/modules/functions.php';
include $_SERVER['DOCUMENT_ROOT'].'/php/modules/crud.php';

$mysql_ = $mysql;
$mysql = $mysql_calc;

$id_bill = "346";
$id = $mysql->real_escape_string($id);
$selector = "`id` = '$id_bill'";
$data = crud_read('project_bills',"*", $selector)[0];

$data = json_decode( fixJsonUTF8($data['data']) );

$bill = $data -> project;
$objects = $data -> objects;

$user_id = $data -> project -> user_id;
$selector = "`id` = '$user_id'";
$user = crud_read('users',"*", $selector)[0];

?>