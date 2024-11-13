<?php

$json_felds = [
    'honorarLevel',
    'honorarLevelDetals',
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

?>