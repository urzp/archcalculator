<?php

$mysql = $mysql_calc;

$selector = "`user_id`='$user_id'";
$collums = " `id`, `name` ,`created` , `updated`, `total` ";
$data = crud_read('projects',$collums, $selector);

$result = (object) [
    'success' => true,
    'data' => $data,
];

?>