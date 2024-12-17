<?php
$mysql = $mysql_calc;

$project_id = $rq_data-> project_id;

$selector = "`project_id`='$project_id' AND `user_id`='$user_id'";

$data = crud_read('project_bills',"*", $selector);
$return_data = [];
foreach($data as $key => $item ){
    $item['data'] = json_decode( fixJsonUTF8($item['data']) );
    array_push($return_data, $item);
}

$result = (object) [
    'success' => true,
    'data' => $return_data,
];

?>