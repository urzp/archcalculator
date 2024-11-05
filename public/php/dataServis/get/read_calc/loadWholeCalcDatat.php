<?php


$data['HOAI_versions'] = crud_read('HOAI_versions');
$data['paragraphs'] = crud_read('paragraphs');
$data['allowableCosts'] = crud_read('allowableCosts');
$data['feeTableTypeValue'] = crud_read('feeTableTypeValue');

$result = (object) [
    'success' => true,
    'data' => $data,
];

?>