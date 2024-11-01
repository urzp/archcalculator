<?php


$data['HOAI_versions'] = crud_read('HOAI_versions');

foreach( $data['HOAI_versions'] as $key => $item ){
   $id =  $item['id'];
   $selector = "`id_HOAI` = '$id'";
   $data['HOAI_versions'][$key]['paragraphs'] = crud_read('paragraphs',"*", $selector);

   foreach( $data['HOAI_versions'][$key]['paragraphs'] as $key_paragraph =>  $item_paragraph ){
        $id_paragraph = $item_paragraph['id'];
        $selector = "`id_paragraph` = '$id'";
        $data['HOAI_versions'][$key]['paragraphs'][$key_paragraph]['allowableCosts'] = crud_read('allowableCosts',"*", $selector);
   }
}


$result = (object) [
    'success' => true,
    'data' => $data,
];

?>