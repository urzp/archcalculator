<?php

switch ($typeData) {
    case 'calc:getHonorarZones': include 'read_calc/getHonorarZones.php'; break;
    case 'getProjectParagraph': include 'read_calc/getProjectParagraph.php'; break;
    case 'getProjectObject': include 'read_calc/getProjectObject.php'; break;
    case 'getProject': include 'read_calc/getProject.php'; break;

    case 'getSameParagraph': include 'read/getSameParagraph.php'; break;
    case 'getParagraph_and_list': include 'read/getParagraph_and_list.php'; break;
    case 'getDafaultHOAI': include 'read/getDafaultHOAI.php'; break;
    case 'FeeTable': include 'read/FeeTable.php'; break;
    case 'Paragraphs': include 'read/Paragraphs.php'; break;
    case 'getHOAI': include 'read/HOAI.php'; break;
    case 'read': include 'read/index.php'; break;
}

?>