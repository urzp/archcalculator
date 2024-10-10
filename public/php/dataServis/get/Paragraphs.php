<?php
$id = $rq_data -> id_HOAI;
$selector = "`id_HOAI` = '$id' ORDER BY cast(`sequence` as unsigned) ASC";
$data = crud_read('paragraphs',"*", $selector);
$result = (object) [
    'success' => true,
    'data' => $data,
];

?>