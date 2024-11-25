<?php

$update_HOAI_time = false;

switch ($typeData) {
    case 'copyStage': include 'copy/Stage.php'; break;
    case 'copySubStage': include 'copy/SubStage.php'; break; 
}

switch ($typeData) {
    case 'delete': include 'delete/index.php'; $update_HOAI_time = true; break;  
    case 'deleteFeeTableRate':  include 'delete/TableRate.php'; $update_HOAI_time = true; break;
    case 'deleteParagraph': include 'delete/Paragraph.php'; $update_HOAI_time = true; break;
    case 'deleteHOAI':  include 'delete/HOAI.php'; $update_HOAI_time = true; break;
}

switch ($typeData) {
    case 'update': include 'update/index.php'; $update_HOAI_time = true; break;  
    case 'updateList': include 'update/List.php'; $update_HOAI_time = true; break;
    case 'updateListRateZoneFeeTable':  include 'update/ListRateZoneFeeTable.php'; $update_HOAI_time = true; break;      
    case 'updateListFeeTableRate':  include 'update/ListFeeTableRate.php'; $update_HOAI_time = true; break;
    case 'updateFeeTableHonorarZonesRateValue': include 'update/FeeTableHonorarZonesRateValue.php'; $update_HOAI_time = true; break;
    case 'updateFeeTableTypeValue': include 'update/FeeTableTypeValue.php'; $update_HOAI_time = true; break;
    case 'updateParagraph': include 'update/Paragraph.php'; $update_HOAI_time = true; break;
    case 'switchPuplishHOAI':  include 'update/switchPuplishHOAI.php'; $update_HOAI_time = true; break;
    case 'updateHOAI':  include 'update/HOAI.php'; $update_HOAI_time = true; break;
    case 'updateFeeTableRate':  include 'update/FeeTableRate.php'; $update_HOAI_time = true; break;
}

switch ($typeData) {
    case 'new': include 'new/index.php'; $update_HOAI_time = true; break;   
    case 'newHonorarZone':  include 'new/HonorarZone.php'; $update_HOAI_time = true; break;              
    case 'newFeeTableHonorarZone':  include 'new/FeeTableHonorarZone.php'; $update_HOAI_time = true; break;
    case 'newFeeTableRate': include 'new/FeeTableRate.php'; $update_HOAI_time = true; break;
    case 'newParagraph':    include 'new/Paragraph.php'; $update_HOAI_time = true; break;
    case 'newHOAI': include 'new/HOAI.php'; $update_HOAI_time = true; break;
}

if($update_HOAI_time){ include 'HOAI_updated_time.php';}

?>