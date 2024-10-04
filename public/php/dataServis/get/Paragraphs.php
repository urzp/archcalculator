<?php
$id = $rq_data -> id_HOAI;
$selector = "`id_HOAI` = '$id'";
$data = crud_read('paragraphs',"*", $selector);
$result = (object) [
    'success' => true,
    'data' => $data,
];

?>