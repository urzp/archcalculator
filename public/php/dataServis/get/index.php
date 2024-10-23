<?php

switch ($typeData) {
    case 'getSameParagraph': include 'read/getSameParagraph.php'; break;
    case 'getParagraph_and_list': include 'read/getParagraph_and_list.php'; break;
    case 'getDafaultHOAI': include 'read/getDafaultHOAI.php'; break;
    case 'FeeTable': include 'read/FeeTable.php'; break;
    case 'Paragraphs': include 'read/Paragraphs.php'; break;
    case 'getHOAI': include 'read/HOAI.php'; break;
    case 'read': include 'read/index.php'; break;
}

?>