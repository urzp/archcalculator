<?php
$mysql = $mysql_calc;

$id = $rq_data ->  id;

$id = $mysql->real_escape_string($id);
$selector = "`id` = '$id' AND `user_id`='$user_id'";


$data['project'] = crud_read('projects',"*", $selector)[0];
if(empty($data['project'])){
    $result = (object) [
        'success' => false,
    ];    
}else{
    $data['project']['customer']=json_decode( fixJsonUTF8($data['project']['customer']) );
    $data['project']['AdditionalServices']=json_decode(  fixJsonUTF8($data['project']['AdditionalServices']) );
    $data['project']['ExtraCosts']=json_decode( fixJsonUTF8( $data['project']['ExtraCosts']) );

    if(!is_array($data['project']['AdditionalServices'])) $data['project']['AdditionalServices'] = [];
    if(!is_array($data['project']['ExtraCosts'])) $data['project']['ExtraCosts'] = [];

    $selector = "`project_id` = '$id' AND `user_id`='$user_id'";
    $data['objects'] = crud_read('project_objects',"*", $selector);

    foreach($data['objects'] as $key => $item ){
        foreach(json_decode( fixJsonUTF8( $item['data'] ) ) as $key_ => $item_  ){
            $data['objects'][$key][$key_] = $item_;
        }
        unset($data['objects'][$key]['data']);
    }

    $selector = "`project_id`='$id' AND `user_id`='$user_id' AND `version`='v_2.0' ORDER BY `number`";
    $data_['bills'] = crud_read('project_bills',"id, number", $selector);

    $i=0;
    foreach($data_['bills'] as $key => $item){
        $i++;
        $newNumber['number']=$i;
        $id_bill = $item['id'];
        $selector = "`id`='$id_bill'";
        crud_update('project_bills', $newNumber, $selector);
    }

    $selector = "`project_id`='$id' AND `user_id`='$user_id' AND `version`='v_2.0' ORDER BY `number`";
    $data['bills'] = crud_read('project_bills',"id, name, total, number,  payment_date_bis , payment_date_vom, paid_date, paid_value, invoice_number, locked", $selector);
    
    $result = (object) [
        'success' => true,
        'data' => $data,
    ];
}




?>