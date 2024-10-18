<?php

switch ($typeData) {
    case 'allowableCosts': include 'read/allowableCosts.php'; break;
    case 'SubStage': include 'read/SubStage.php'; break;
    case 'Stages': include 'read/Stages.php'; break;
    case 'HonorarZone': include 'read/HonorarZone.php'; break;
    case 'RequirementsPoints': include 'read/RequirementsPoints.php'; break;
    case 'FeeTable': include 'read/FeeTable.php'; break;
    case 'Paragraphs': include 'read/Paragraphs.php'; break;
    case 'getHOAI': include 'read/HOAI.php'; break;
}

?>