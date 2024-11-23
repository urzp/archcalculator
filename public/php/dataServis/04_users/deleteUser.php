<?php

$data = $rq_data -> data;
$selector = " `id` = '$user_id' AND `token` = '$token' ";
$data = crud_read('users',"*", $selector)[0];

$dataTrash['old_id'] = $data['id'];
$dataTrash['email'] = $data['email'];
$dataTrash['content'] = json_encode($data);

crud_create('remoteUsers', $dataTrash);
crud_delete('users',$selector);

$result = (object) [
    'success' => true,
];

?>