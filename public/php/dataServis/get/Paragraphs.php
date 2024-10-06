<?php
$id = $rq_data -> id_HOAI;
$selector = "`id_HOAI` = '$id' ORDER BY `sequence` ASC";
$data = crud_read('paragraphs',"*", $selector);
$result = (object) [
    'success' => true,
    'data' => $data,
];

?>