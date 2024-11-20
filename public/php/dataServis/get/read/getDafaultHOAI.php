<?php

$selector = "`name`='default_paragraph'";
$data = crud_read('settings', "*", $selector);
$id_pargraph = $data[0]['value'];

$selector = "`id`='$id_pargraph'";
$data = crud_read('paragraphs', "*", $selector);
$data = $data[0];

$result = (object) [
    'success' => true,
    'data' => $data,
];

?>