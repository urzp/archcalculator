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

include 'get/index.php';
include 'set/index.php';
include 'users/index.php';

echo json_encode($result);

?>