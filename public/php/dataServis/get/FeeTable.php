<?php
$id = $rq_data -> id;
$selector = "`id_paragraph` = '$id'";
$data['typetype_value'] = crud_read('feeTableTypeValue',"*", $selector);
if( empty( $data['typetype_value'] ) ){
    $newNote['id_paragraph'] = $id;
    crud_create('feeTableTypeValue', $newNote);
}else{
    $data['typetype_value'] = crud_read('feeTableTypeValue',"*", $selector);
}

$selector = "`id_paragraph` = '$id' ORDER BY  cast(`number` as unsigned)  ASC";
$data['rate_values'] = crud_read('feeTableRateValue',"*", $selector);
$data['honorarZones'] = crud_read('feeTableHonorarZones',"*", $selector);


foreach ($data['rate_values'] as $key=>$item){
    $zones = [];
    $id_feeTableRateValue = $item['id'];
    foreach ($data['honorarZones'] as $item_){
        $RateAndHonorarZones = [];
        $id_feeTableHonorarZones = $item_['id'];
        $selector = "`id_feeTableRateValue` = '$id_feeTableRateValue' AND `id_feeTableHonorarZones` = '$id_feeTableHonorarZones'";
        $RateAndHonorarZones = crud_read('feeTableHonorarZonesRateValue',"*", $selector);
        if( empty($RateAndHonorarZones) ){
            $newRateZone['id_feeTableRateValue'] = $id_feeTableRateValue;
            $newRateZone['id_feeTableHonorarZones'] = $id_feeTableHonorarZones;
            crud_create('feeTableHonorarZonesRateValue', $newRateZone);
            $RateAndHonorarZones = crud_read('feeTableHonorarZonesRateValue',"*", $selector);
        }
        array_push($zones, $RateAndHonorarZones[0]);
    }
    $data['rate_values'][$key]['zones'] = $zones;
}

$result = (object) [
    'success' => true,
    'data' => $data,
];

?>