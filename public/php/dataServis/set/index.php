<?php

switch ($typeData) {
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