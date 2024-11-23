<?php

switch ($typeData) {
    case 'getProject': include 'getProject.php'; break;
    case 'getProjectObject': include 'getProjectObject.php'; break;
    case 'getProjectParagraph': include 'getProjectParagraph.php'; break;
    case 'loadWholeProject': include 'loadWholeProject.php'; break;

    case 'updateProject': include 'updateProject.php'; break;
    case 'deleteProjectObject': include 'deleteProjectObject.php'; break;
    case 'newProjectObject': include 'newProjectObject.php'; break;
    case 'updateProjectPoints': include 'updateProjectPoints.php'; break;
    case 'updateProjectObject': include 'updateProjectObject.php'; break;
}

?>