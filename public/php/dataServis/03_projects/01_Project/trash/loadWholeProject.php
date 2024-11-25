<?php
$id = $rq_data ->  id;
$selector = "`id` = '$id'";

$mysql = $mysql_calc;
$data['project'] = crud_read('projects',"*", $selector)[0];
$data['project']['AdditionalServices']=json_decode($data['project']['AdditionalServices']);
$data['project']['ExtraCosts']=json_decode($data['project']['ExtraCosts']);

$selector = "`project_id` = '$id'";
$data['objects'] = crud_read('objects',"*", $selector);

foreach($data['objects'] as $key => $item ){
    $data['objects'][$key]['honorarLevel'] = json_decode( $item['honorarLevel'] );
    $data['objects'][$key]['honorarLevelDetals'] = json_decode( $item['honorarLevelDetals'] );
    $data['objects'][$key]['HonorarRate'] = json_decode( $item['HonorarRate'] );
    $data['objects'][$key]['finance'] = json_decode( $item['finance'] );
    $data['objects'][$key]['payExtra'] = json_decode( $item['payExtra'] );
    $data['objects'][$key]['stages'] = json_decode( $item['stages'] );
    $data['objects'][$key]['stages_L0'] = json_decode( $item['stages_L0'] );
    $data['objects'][$key]['stages_L1'] = json_decode( $item['stages_L1'] );
    $data['objects'][$key]['specialServices'] = json_decode( $item['specialServices'] );
}


$result = (object) [
    'success' => true,
    'data' => $data,
];

?>