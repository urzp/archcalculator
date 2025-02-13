<?php
$mysql = $mysql_calc;

$id = $rq_data ->  id;

$id = $mysql->real_escape_string($id);
$selector = "`id` = '$id' AND `user_id`='$user_id'";

$data = crud_read('project_bills',"*", $selector)[0];

if(empty($data)){
    $result = (object) [
        'success' => false,
    ];    
}else{
    $data = json_decode( fixJsonUTF8($data['data']) );

    $project_id = $data -> project -> id_project_contract;
    $selector = "`project_id`='$project_id' AND `user_id`='$user_id' AND `version`='v_2.0' ORDER BY `number`";
    $data->bills = crud_read('project_bills',"id, name, total, number,  payment_date_bis , payment_date_vom, paid_date, paid_value, invoice_number, locked", $selector);

    if($data->project->locked=='0'){ //update actual data
        $new_previos_payments = [];
        foreach( $data->project->previos_payments as $key=>$item){
            $id_item = $item->id;
            foreach($data->bills as $key_=>$item_){
                $id_item_ = $item_['id'];
                if($id_item == $id_item_) array_push($new_previos_payments,  $item_) ;
            }
        }
        $data->project->previos_payments = $new_previos_payments;
    }

    $result = (object) [
        'success' => true,
        'selector' => $selector,
        'data' => $data,
    ];

}


?>