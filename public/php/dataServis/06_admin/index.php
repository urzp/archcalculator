<?php

if($isAdmin){

    switch ($typeData) {
        case 'adminSiteBarData': include 'AdminSiteBarData.php'; break;
        case 'adminUserData': include 'AdminUserData.php'; break;
        case 'adminProjectData': include 'AdminProjectData.php'; break;
        case 'adminProfilUserData': include 'AdminProfilUserData.php'; break;
        case 'adminBillsData': include 'AdminBillsData.php'; break;
        case 'adminUserProjects': include 'AdminUserProjects.php'; break;
    }

}

?>