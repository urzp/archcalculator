<?php

function findSame($key){
    global $paragraphs, $paragraph;
    $result = '';
    foreach($paragraphs as  $item){
        if($item[$key] == $paragraph[$key]){ $result = $item['id'];}
    }  
    return $result;
}

$id = $rq_data -> data -> id_paragpaph;
$id_HOAI = $rq_data -> data -> id_HOAI;

$selector = "`id` = '$id'";
$paragraph = crud_read('paragraphs',"*", $selector)[0];

$selector = "`id_HOAI` = '$id_HOAI' ORDER BY cast(`sequence` as unsigned) ASC";
$paragraphs = crud_read('paragraphs',"*", $selector);

$data['paragraph']=$paragraph;
$data['paragraphs']=$paragraphs;

$result = '';

if(count($paragraphs) > 0){
    $result = findSame('title');
    if($result == ''){ $result = findSame('name'); }
    if($result == ''){ $result = $paragraphs[0]['id']; }
}

$result = (object) [
    'success' => true,
    'data' => $result,
];

?>