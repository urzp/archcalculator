<?php

$selector = " `name` = 'HOAI_updated' ";
$data['settings'] = crud_read('settings', 'value' , $selector)[0];

$result = (object) [
    'success' => true,
    'data' => $data['settings'],
];

?>