<?php


$selector = " true ORDER BY cast(`sequence` as unsigned) ASC";
$data = crud_read('HOAI_versions',"*", $selector);


foreach ($data as $key => $item){
    $id = $item['id'];
    $selector = "`id` = '$id'";
    $udateData['sequence'] = $key + 1;
    crud_update('HOAI_versions', $udateData, $selector);
}

$input_data = $rq_data -> data;
foreach ($input_data as $key => $value){$newdata[$key] = $value;}
$newdata['sequence'] = count($data)+1;
crud_create('HOAI_versions', $newdata);

$result = (object) [
    'success' => true,
    'data' => '',
];

?>