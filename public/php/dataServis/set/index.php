<?php

switch ($typeData) {
    case 'copyStage': include 'copy/Stage.php'; break;
    case 'copySubStage': include 'copy/SubStage.php'; break; 
}

switch ($typeData) {
    case 'deleteAllowableCosts': include 'delete/AllowableCosts.php';break; 
    case 'deleteSubStages': include 'delete/SubStage.php';break; 
    case 'deleteStages': include 'delete/Stages.php';break; 
    case 'deleteHonorarZone': include 'delete/HonorarZone.php'; break;
    case 'deleteRequirementsPoints': include 'delete/RequirementsPoints.php'; break;
    case 'deleteFeeTableHonorarZone': include 'delete/FeeTableHonorarZone.php'; break;
    case 'deleteFeeTableRate':  include 'delete/TableRate.php'; break;
    case 'deleteParagraph': include 'delete/Paragraph.php'; break;
    case 'deleteHOAI':  include 'delete/HOAI.php'; break;
}

switch ($typeData) {
    case 'updateAllowableCosts': include 'update/AllowableCosts.php'; break;  
    case 'updateList': include 'update/List.php'; break;
    case 'updateSubStage': include 'update/SubStage.php'; break; 
    case 'updateStages': include 'update/Stages.php'; break; 
    case 'updateHonorarZone':   include 'update/HonorarZone.php'; break; 
    case 'updateRequirementsPoints':    include 'update/RequirementsPoints.php'; break;
    case 'updateListRateZoneFeeTable':  include 'update/ListRateZoneFeeTable.php'; break;      
    case 'updateListFeeTableRate':  include 'update/ListFeeTableRate.php'; break;
    case 'updateFeeTableHonorarZonesRateValue': include 'update/FeeTableHonorarZonesRateValue.php'; break;
    case 'updateFeeTableTypeValue': include 'update/FeeTableTypeValue.php'; break;
    case 'updateParagraph': include 'update/Paragraph.php'; break;
    case 'updateHOAI':  include 'update/HOAI.php'; break;
    case 'updateFeeTableRate':  include 'update/FeeTableRate.php'; break;
}

switch ($typeData) {
    case 'newAllowableCosts': include 'new/AllowableCosts.php';break;   
    case 'newSubStage': include 'new/SubStage.php'; break;   
    case 'newStage':    include 'new/Stage.php'; break;      
    case 'newHonorarZone':  include 'new/HonorarZone.php'; break;         
    case 'newRequirementsPoints':   include 'new/RequirementsPoints.php'; break;         
    case 'newFeeTableHonorarZone':  include 'new/FeeTableHonorarZone.php'; break;
    case 'newFeeTableRate': include 'new/FeeTableRate.php'; break;
    case 'newParagraph':    include 'new/Paragraph.php'; break;
    case 'newHOAI': include 'new/HOAI.php'; break;
}

?>