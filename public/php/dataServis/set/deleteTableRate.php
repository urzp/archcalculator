<?php

$id = $rq_data -> data;
$selector = "`id` = '$id'";
crud_delete('feeTableRateValue',$selector);
$selector = "`id_feeTableRateValue` = '$id'";
crud_delete('feeTableHonorarZonesRateValue',$selector);

$result = (object) [
    'success' => true,
    'data' => '',
];

?>