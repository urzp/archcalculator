<?php

$input_data = $rq_data -> data;
$id = $input_data -> id;

$json_felds = [
    'honorarLevel',
    'requirementsPoints',
    'requirementsPointsNames',
    'HonorarRate',
    'finance',
    'payExtra',
    'stages',
    'stages_L0',
    'stages_L1',
    'specialServices'
];

foreach ($input_data as $key => $value){
    $newdata[$key] = $value; 
    if(in_array($key, $json_felds)){
        if($value==''){$value = (object)[];}
        $newdata[$key] = json_encode($value);
    }
}
$selector = "`id` = '$id'";
$mysql = $mysql_calc;
crud_update('objects', $newdata, $selector);

$result = (object) [
    'success' => true,
    'data' => '',
];

?>