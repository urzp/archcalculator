<?php

$input_data = $rq_data -> data;

$data['id_HOAI'] = $input_data -> id_HOAI;
$data['name'] = $input_data -> name;
$data['sequence'] = $input_data -> sequence;
crud_create('paragraphs', $data);

$id = end(crud_read('paragraphs'))['id'];


$result = (object) [
    'success' => true,
    'id' => $id,
];

?>