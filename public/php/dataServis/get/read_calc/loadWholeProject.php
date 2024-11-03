<?php
$id = $rq_data ->  id;
$selector = "`id` = '$id'";

$mysql = $mysql_calc;
$data['project'] = crud_read('projects',"*", $selector)[0];

$selector = "`project_id` = '$id'";
$data['objects'] = crud_read('objects',"*", $selector);

foreach($data['objects'] as $key => $item ){
    $data['objects'][$key]['honorarLevel'] = json_decode( $item['honorarLevel'] );
    $data['objects'][$key]['requirementsPoints'] = json_decode( $item['requirementsPoints'] );
    $data['objects'][$key]['requirementsPointsNames'] = json_decode( $item['requirementsPointsNames'] );
    $data['objects'][$key]['HonorarRate'] = json_decode( $item['HonorarRate'] );
    $data['objects'][$key]['finance'] = json_decode( $item['finance'] );
}


$result = (object) [
    'success' => true,
    'data' => $data,
];

?>