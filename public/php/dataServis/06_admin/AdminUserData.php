<?php

$mysql = $mysql_calc;
$collums='id, dateCreate, email, email_confirmed, name, subscription_period_end, stripe_custemer_id';
$users = crud_read('users', $collums);

foreach($users as $key => $item){
    $id = $item['id'];
    $selector = "`user_id` = '$id'";
    $users[$key]['projects']=crud_count('projects', $selector);
    $selector = $selector." AND `status`='project'";
    $users[$key]['contracts']=crud_count('projects', $selector);
    $selector = "`user_id` = '$id'";
    $users[$key]['bills']=crud_count('project_bills', $selector);
    if($item['subscription_period_end']=='0000-00-00 00:00:00'){
        $users[$key]['subscription'] = '-';
    }else{
        $users[$key]['subscription'] = date("Y-m-d", strtotime($item['subscription_period_end']));
    }
    
}

$result = (object) [
    'success' => true,
    'users' => $users,
];

?>