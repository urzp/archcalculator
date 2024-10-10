<?php
$id = $rq_data -> id;
$selector = "`id_paragraph` = '$id' ORDER BY cast(`sequence` as unsigned) ASC";
$data = crud_read('requirementsPoints',"*", $selector);

foreach($data as $key=>$item){
    $data[$key]['sequence']= $key + 1;
    $id = $item["id"];

    $update = [];
    $selector = "`id`='$id'";
    $update['sequence'] = $key + 1;
    crud_update('requirementsPoints', $update, $selector);
}

$result = (object) [
    'success' => true,
    'data' => $data,
];

?>