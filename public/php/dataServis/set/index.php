<?php

switch ($typeData) {
    case 'deleteHonorarZone':
        include 'deleteHonorarZone.php';
        break;         
    case 'newHonorarZone':
        include 'newHonorarZone.php';
        break;   
    case 'updateHonorarZone':
        include 'updateHonorarZone.php';
        break;           
    case 'deleteRequirementsPoints':
        include 'deleteRequirementsPoints.php';
        break;        
    case 'newRequirementsPoints':
        include 'newRequirementsPoints.php';
        break;         
    case 'updateRequirementsPoints':
        include 'updateRequirementsPoints.php';
        break;  
    case 'updateListRateZoneFeeTable':
        include 'updateListRateZoneFeeTable.php';
        break;      
    case 'updateListFeeTableRate':
        include 'updateListFeeTableRate.php';
        break;
    case 'updateFeeTableHonorarZonesRateValue':
        include 'updateFeeTableHonorarZonesRateValue.php';
        break;
    case 'updateFeeTableTypeValue':
        include 'updateFeeTableTypeValue.php';
        break;
    case 'deleteFeeTableHonorarZone':
        include 'deleteFeeTableHonorarZone.php';
        break;
    case 'newFeeTableHonorarZone':
        include 'newFeeTableHonorarZone.php';
        break;
    case 'deleteFeeTableRate':
        include 'deleteTableRate.php';
        break;
    case 'updateFeeTableRate':
        include 'updateFeeTableRate.php';
        break;
    case 'newFeeTableRate':
        include 'newFeeTableRate.php';
        break;
    case 'deleteParagraph':
        include 'deleteParagraph.php';
        break;
    case 'newParagraph':
        include 'newParagraph.php';
        break;
    case 'updateParagraph':
        include 'updateParagraph.php';
        break;
    case 'updateHOAI':
        include 'updateHOAI.php';
        break;
    case 'deleteHOAI':
        include 'deleteHOAI.php';
        break;
    case 'newHOAI':
        include 'newHOAI.php';
        break;
}

?>