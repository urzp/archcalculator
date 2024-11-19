<?php

$mysql = $mysql_calc;

switch ($typeData){
    case 'resetPassword': include 'resetPassword.php'; break;
    case 'registration': include 'registration.php'; break;
    case 'notHasEmail': include 'notHasEmail.php'; break;
    case 'login': include 'login.php'; break;
}

?>