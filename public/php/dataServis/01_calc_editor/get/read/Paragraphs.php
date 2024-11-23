<?php
$id = $rq_data -> id_HOAI;
$selector = "`id_HOAI` = '$id' ORDER BY cast(`sequence` as unsigned) ASC";
$data = crud_read('paragraphs',"*", $selector);

foreach($data as $key=>$item){
    $data[$key]['sequence']= $key + 1;
    $id = $item["id"];

    $update = [];
    $selector = "`id`='$id'";
    $update['sequence'] = $key + 1;
    crud_update('paragraphs', $update, $selector);
}

$result = (object) [
    'success' => true,
    'data' => $data,
];

?>