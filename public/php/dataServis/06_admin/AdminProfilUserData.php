<?php

$id = $rq_data ->  id;

$mysql = $mysql_calc;
$selector = "`id`='$id'" ;
$collums='*';
$user = crud_read('users', $collums, $selector)[0];
unset($user['password']);
unset($user['token']);


$selector = "`user_id` = '$id'";
$user['projects']=crud_count('projects', $selector);
$selector = $selector." AND `status`='project'";
$user['contracts']=crud_count('projects', $selector);
$selector = "`user_id` = '$id'";
$user['bills']=crud_count('project_bills', $selector);
if($user['subscription']=='0000-00-00 00:00:00'){
    $user['subscription'] = '-';
}else{
    $user['subscription'] = date("Y-m-d", strtotime($item['subscription']));
}

if($user['avatar']!='') $user['avatar'] = 'https://honorar.online/users/user_'.$id.'/avatar/'.$user['avatar'];



$result = (object) [
    'success' => true,
    'user' => $user,
];

?>