<?php

$mysql = $mysql_calc;

$bill_id = $rq_data-> id;


$id = $_GET['bill'];
$downLoad_token = $_GET['downLoad_token'];
$type = $_GET['type'];
$id = $mysql->real_escape_string($id);
$downLoad_token = $mysql->real_escape_string($downLoad_token);

if($downLoad_token!=''){
    

$selector = "`id`='$id' AND `downLoad_token`='$downLoad_token'";

$bill = crud_read('project_bills',"*", $selector);
$bill = $bill[0];

$bill['data'] = json_decode( fixJsonUTF8($bill['data']) );
$bill['data'] -> id = $bill['id'];
$bill['data'] -> updated = $bill['updated'];
$bill['data'] -> created = $bill['created'];



switch ($type) {
    case 'excel': include "excel/bill/excel.php"; break;
    case 'pdf': include "pdf/bill/pdf.php"; break;
}

}


?>