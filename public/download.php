<?php

include $_SERVER['DOCUMENT_ROOT'].'/php/config.php';
include $_SERVER['DOCUMENT_ROOT'].'/php/modules/functions.php';
//header('content-type: application/json; charset=utf-8');
//header('Access-Control-Allow-Origin: *');

include 'escapeSQL_injection.php';
include $_SERVER['DOCUMENT_ROOT'].'/php/modules/crud.php';

if(isset($_GET['bill'])) include $_SERVER['DOCUMENT_ROOT'].'/php/dataServis/05_exportDoc/selectBill.php';
if(isset($_GET['project'])) include $_SERVER['DOCUMENT_ROOT'].'/php/dataServis/05_exportDoc/selectProject.php';

?>