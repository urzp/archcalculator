<?php

$id = $rq_data -> data;
$selector = "`id` = '$id'";
crud_delete('feeTableHonorarZones',$selector);
$selector = "`id_feeTableHonorarZones` = '$id'";
crud_delete('feeTableHonorarZonesRateValue',$selector);

$result = (object) [
    'success' => true,
    'data' => '',
];

?>