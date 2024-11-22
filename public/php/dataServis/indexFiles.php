<?php
include $_SERVER['DOCUMENT_ROOT'].'/php/modules/crud.php';
$mysql = $mysql_calc;
$typeData = $_POST['typeData'];

switch ($typeData){
    case 'avatar': include 'users/avatar.php'; break;
}

echo json_encode($result);

?>