<?php

switch ($typeData) {
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