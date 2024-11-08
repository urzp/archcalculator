<?php


$data['HOAI_versions'] = crud_read('HOAI_versions');
$data['paragraphs'] = crud_read('paragraphs');
$data['allowableCosts'] = crud_read('allowableCosts');

$data['feeTableHonorarZones'] = crud_read('feeTableHonorarZones');

$data['feeTableTypeValue'] = crud_read('feeTableTypeValue');
$data['feeTableRateValue'] = crud_read('feeTableRateValue');
$data['feeTableHonorarZonesRateValue'] = crud_read('feeTableHonorarZonesRateValue');
$data['requirementsPoints'] = crud_read('requirementsPoints');

$data['Stages'] = crud_read('Stages');
$data['subStage'] = crud_read('subStage');
$data['subStage_l1'] = crud_read('subStage_l1');

$result = (object) [
    'success' => true,
    'data' => $data,
];

?>