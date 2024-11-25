<?php

switch ($typeData) {    
    case 'calc:getHOAI_updated': include 'getHOAI_updated.php';break;
    case 'calc:AllowableCosts': include 'allowableCosts.php';break;
    case 'calc:feeTableTypeValue': include 'feeTableTypeValue.php';break;
    case 'calc:getHonorarZones': include 'getHonorarZones.php'; break;
    case 'loadWholeCalcData': include 'loadWholeCalcDatat.php'; break;
    case 'calc:requirementsPoints': include 'requirementsPoints.php';break;
}

?>