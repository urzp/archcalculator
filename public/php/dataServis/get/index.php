<?php

switch ($typeData) {
    case 'allowableCosts':
        include 'allowableCosts.php';
        break;
    case 'SubStage':
        include 'SubStage.php';
        break;
    case 'Stages':
        include 'Stages.php';
        break;
    case 'HonorarZone':
        include 'HonorarZone.php';
        break;
    case 'RequirementsPoints':
        include 'RequirementsPoints.php';
        break;
    case 'FeeTable':
        include 'FeeTable.php';
        break;
    case 'Paragraphs':
        include 'Paragraphs.php';
        break;
    case 'getHOAI':
        include 'HOAI.php';
        break;
}

?>