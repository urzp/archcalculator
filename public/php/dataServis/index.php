<?php
include $_SERVER['DOCUMENT_ROOT'].'/php/config.php';
include $_SERVER['DOCUMENT_ROOT'].'/php/modules/functions.php';
header('Access-Control-Allow-Origin: *');
if($_POST['SendFile']){include 'indexFiles.php';exit();}

$post = file_get_contents("php://input");
$post = json_decode($post);

$user_id = $post-> user_id;
$token = $post -> token;
$rq_data = $post -> rq_data;
$typeData = $rq_data -> typeData;

include 'escapeSQL_injection.php';
include 'checkAccess.php';

include $_SERVER['DOCUMENT_ROOT'].'/php/modules/crud.php';

$result = (object) [
    'success' => false,
    'msg' => 'not type data',
];

include '01_calc_editor/index.php';
include '02_calc/index.php';
include '02_calc/_index.php';
include '03_projects/_index.php';
include '04_users/index.php';

echo json_encode($result);

?>