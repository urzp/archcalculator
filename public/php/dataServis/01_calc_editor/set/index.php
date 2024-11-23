<?php

switch ($typeData) {
    case 'copyStage': include 'copy/Stage.php'; break;
    case 'copySubStage': include 'copy/SubStage.php'; break; 
}

switch ($typeData) {
    case 'delete': include 'delete/index.php'; break;  
    case 'deleteFeeTableRate':  include 'delete/TableRate.php'; break;
    case 'deleteParagraph': include 'delete/Paragraph.php'; break;
    case 'deleteHOAI':  include 'delete/HOAI.php'; break;
}

switch ($typeData) {
    case 'update': include 'update/index.php'; break;  
    case 'updateList': include 'update/List.php'; break;
    case 'updateListRateZoneFeeTable':  include 'update/ListRateZoneFeeTable.php'; break;      
    case 'updateListFeeTableRate':  include 'update/ListFeeTableRate.php'; break;
    case 'updateFeeTableHonorarZonesRateValue': include 'update/FeeTableHonorarZonesRateValue.php'; break;
    case 'updateFeeTableTypeValue': include 'update/FeeTableTypeValue.php'; break;
    case 'updateParagraph': include 'update/Paragraph.php'; break;
    case 'updateHOAI':  include 'update/HOAI.php'; break;
    case 'updateFeeTableRate':  include 'update/FeeTableRate.php'; break;
}

switch ($typeData) {
    case 'new': include 'new/index.php'; break;   
    case 'newHonorarZone':  include 'new/HonorarZone.php'; break;              
    case 'newFeeTableHonorarZone':  include 'new/FeeTableHonorarZone.php'; break;
    case 'newFeeTableRate': include 'new/FeeTableRate.php'; break;
    case 'newParagraph':    include 'new/Paragraph.php'; break;
    case 'newHOAI': include 'new/HOAI.php'; break;
}

?>