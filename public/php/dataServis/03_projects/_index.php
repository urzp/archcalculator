<?php

if($isLogin){
$mysql = $mysql_calc;

switch ($typeData) {
    case 'deleteProject': include  '01_Project/deleteProject.php'; break;
    case 'getProjectShowData': include '01_Project/getProjectShowData.php'; break;
    case 'getProjects': include '01_Project/getProjects.php'; break;
    case 'newProject': include '01_Project/newProject.php'; break;
    case 'loadWholeProject': include '01_Project/loadWholeProject.php'; break;
    case 'updateProject': include '01_Project/updateProject.php'; break;

    case 'deleteProjectObject': include '02_Object/deleteProjectObject.php'; break;
    case 'newProjectObject': include '02_Object/newProjectObject.php'; break;
    case 'updateProjectObject': include '02_Object/updateProjectObject.php'; break;

    // case 'getProject': include 'getProject.php'; break;
    // case 'getProjectObject': include 'getProjectObject.php'; break;
    // case 'getProjectParagraph': include 'getProjectParagraph.php'; break;
    // case 'updateProjectPoints': include 'updateProjectPoints.php'; break;
}

}

?>