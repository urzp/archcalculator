<?php
$id = $rq_data ->  id;
$selector = "`id` = '$id'";

$mysql = $mysql_calc;
$data['project'] = crud_read('projects',"*", $selector)[0];

$selector = "`project_id` = '$id'";
$data['objects'] = crud_read('objects',"*", $selector);

foreach($data['objects'] as $key => $item ){
    $data['objects'][$key]['requirementsPoints'] = json_decode( $item['requirementsPoints'] );
}


$result = (object) [
    'success' => true,
    'data' => $data,
];

?>