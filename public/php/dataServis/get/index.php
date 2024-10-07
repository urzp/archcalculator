<?php

switch ($typeData) {
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