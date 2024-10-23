<?php

$id = $rq_data -> id_pargraph;
$selector = "`id` = '$id'";
$paragraph = crud_read('paragraphs',"*", $selector)[0];
$id_HOAI = $paragraph['id_HOAI'];
$selector = "`id_HOAI` = '$id_HOAI' ORDER BY cast(`sequence` as unsigned) ASC";
$paragraphs = crud_read('paragraphs',"*", $selector);

$data['paragraph']=$paragraph;
$data['paragraphs']=$paragraphs;

$result = (object) [
    'success' => true,
    'data' => $data,
];

?>