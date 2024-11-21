<?php

$mysql = $mysql_calc;

switch ($typeData){
    case 'isUserUpdated': include 'isUserUpdated.php'; break;
    case 'isLogin': include 'isLogin.php'; break;
    case 'resetPassword': include 'resetPassword.php'; break;
    case 'registration': include 'registration.php'; break;
    case 'notHasEmail': include 'notHasEmail.php'; break;
    case 'login': include 'login.php'; break;
}

?>