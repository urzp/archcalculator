<?php

$id = $rq_data -> data;
$selector = "`id` = '$id'";


$data =  crud_read('HOAI_versions', '*' , $selector)[0];
$puplish = $data['puplish'];
if($puplish=='1'){  $puplish = 0;}else{ $puplish = 1;}

$update_data['puplish'] = $puplish;
crud_update('HOAI_versions', $update_data, $selector);

$result = (object) [
    'success' => true,
];

?>