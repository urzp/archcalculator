<?php
include $_SERVER['DOCUMENT_ROOT'].'/php/config.php';
include $_SERVER['DOCUMENT_ROOT'].'/php/modules/functions.php';
header('content-type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
if($_POST['SendFile']){include 'indexFiles.php';exit();}

$post = file_get_contents("php://input");
$post = json_decode($post);

$user_id = $post-> user_id;
$token = $post -> token;
$rq_data = $post -> rq_data;
$typeData = $rq_data -> typeData;

include 'escapeSQL_injection.php';

include $_SERVER['DOCUMENT_ROOT'].'/php/modules/crud.php';
include 'checkAccess.php';

$result = (object) [
    'success' => false,
    'msg' => 'not type data',
];

include '01_calc_editor/index.php';
include '02_calc/_index.php';
include '03_projects/_index.php';
include '04_users/index.php';
include '05_exportDoc/index.php';
include '06_admin/index.php';
include '07_pages/index.php';
include '08_stripe/index.php';

echo json_encode($result);

?>