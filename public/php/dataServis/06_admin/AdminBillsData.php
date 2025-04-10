<?php

$mysql = $mysql_calc;
$collums='id, created, user_id, number, project_id, name, downLoad_token';
$bills = crud_read('project_bills', $collums);

foreach($bills as $key => $item){
    $id = $item['user_id'];
    
    if($id!='-1'){
        $selector = "`id` = '$id'";
        $collums = 'email';
        $bills[$key]['user']=crud_read('users', $collums, $selector)[0]['email'];
    }else{
        $bills[$key]['user']="-";
    }

    $collums = 'name';
    $project_id = $item['project_id'];
    $selector = "`id` = '$project_id'";
    $bills[$key]['name_project']=crud_read('projects', $collums, $selector)[0]['name'];

}

$result = (object) [
    'success' => true,
    'projects' => $bills,
];

?>