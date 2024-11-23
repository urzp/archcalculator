<?php

$user_id =  $_POST['user_id'];
$token = $_POST['token']; 

$target_dir_ = $_SERVER['DOCUMENT_ROOT'].'/users/user_'.$user_id.'/avatar';


removeDirectory($target_dir_);
if (!file_exists($target_dir_)) {
    mkdir($target_dir_, 0777, true);
}

if(basename( $_FILES['avatar']['name'])!=''){
    $new_name_file = time().'_'.basename( $_FILES['avatar']['name']);
    $target_file = $target_dir_.'/'.$new_name_file;
    move_uploaded_file($_FILES['avatar']['tmp_name'], $target_file);
}else{
    $new_name_file = '';
}

$data['avatar'] = $new_name_file;
$selector = " `id` = '$user_id' AND `token` = '$token' ";
crud_update('users', $data, $selector);

$result = (object) [
    'success' => true,
];


function removeDirectory($dir) {
    if ($objs = glob($dir . '/*')) {
        foreach($objs as $obj) {
            is_dir($obj) ? removeDirectory($obj) : unlink($obj);
        }
    }
}

?>