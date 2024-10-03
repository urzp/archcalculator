<?php

$data = crud_read('HOAI_versions');
$result = (object) [
    'success' => true,
    'data' => $data,
];

?>