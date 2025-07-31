<?php

$mysql = $mysql_calc;
$data = crud_read('tariffs');

$return_data = [];
foreach($data as $key => $item ){
    $item['data'] = json_decode( fixJsonUTF8($item['data']) );
    $item['data']-> id = $item['id'];
    array_push($return_data, $item['data']);
}

$result = (object) [
    'success' => true,
    'data' => $return_data,
];

?>