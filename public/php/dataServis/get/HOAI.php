<?php
$selector = " true ORDER BY cast(`sequence` as unsigned) ASC";
$data = crud_read('HOAI_versions',"*", $selector);
$result = (object) [
    'success' => true,
    'data' => $data,
];

?>