<?php

switch ($typeData) {
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