<?php

$mysql = $mysql_calc;
$collums='id, created, user_id, status, name, downLoad_token';
$projects = crud_read('projects', $collums);

foreach($projects as $key => $item){
    $id = $item['user_id'];
    
    if($id!='-1'){
        $selector = "`id` = '$id'";
        $collums = 'email';
        $projects[$key]['user']=crud_read('users', $collums, $selector)[0]['email'];
    }else{
        $projects[$key]['user']="-";
    }
}

$result = (object) [
    'success' => true,
    'projects' => $projects,
];

?>