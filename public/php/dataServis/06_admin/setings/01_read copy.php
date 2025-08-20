<?php
$mysql = $mysql_calc;
$return_data = crud_read('settings');

$result = (object) [
    'success' => true,
    'data' => $return_data,
];
?>