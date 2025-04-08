<?php

if($isAdmin){

    switch ($typeData) {
        case 'adminSiteBarData': include 'AdminSiteBarData.php'; break;
        case 'adminUserData': include 'AdminUserData.php'; break;
    }

}

?>