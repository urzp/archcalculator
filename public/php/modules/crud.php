<?php

include 'config.php';

function crud_read($table, $collums="*" , $selector="" ){
    global $mysql;
    if($collums=='') $collums="*";
    if ($selector!='') $selector = "WHERE ".$selector;
    $sql = "SELECT $collums FROM `$table` $selector ";
    //echo $sql.'<br/>';
    $sql_result = $mysql -> query($sql);
    $data = [];
    foreach($sql_result as $item){ array_push($data, $item ); }
    return $data;
}

function crud_create($table, $data){
    global $mysql;
    $fields_name = '';
    $fields_value = '';
    foreach($data as $item => $item_val) {
        $item = $mysql->real_escape_string($item);
        $item_val = $mysql->real_escape_string($item_val);
        $fields_name = $fields_name."`".$item."`".', ';
        $fields_value = $fields_value."'".$item_val."'".', ';
    }
    $fields_name = substr($fields_name, 0, -2);
    $fields_value = substr($fields_value, 0, -2);
    $sql = "INSERT INTO `$table` ( $fields_name ) VALUES ( $fields_value )";
    //echo $sql.'<br/>';
    $mysql -> query($sql);
}

function crud_update($table, $data, $selector="", $jsonFeeld='', $jsonDataElement=''){
    if($selector=="") return false;
    global $mysql;
    $sql_data = '';

    if($jsonFeeld!=''){
       $jsonData = crud_read($table, $jsonFeeld, $selector)[0]['data'];
       $jsonData = json_decode($jsonData);
       $jsonData -> {$jsonDataElement['name']} = $jsonDataElement['value'];
       $data[$jsonFeeld]=json_encode($jsonData);
    }

    foreach($data as $item => $item_val) {
        $item = $mysql->real_escape_string($item);
        $item_val = $mysql->real_escape_string($item_val);
        $sql_data = $sql_data."`".$item."`='".$item_val."'".', ';
    }
    $sql_data = substr($sql_data, 0, -2);
    $sql = "UPDATE `$table` SET $sql_data WHERE $selector";
    //echo $sql.'<br/>';
    $mysql -> query($sql);
    return $jsonData;
}

function crud_delete($table, $selector=""){
    if($selector=="") return false;
    global $mysql;
    $sql = "DELETE FROM `$table` WHERE $selector";
    //echo $sql.'<br/>';
    $mysql -> query($sql);
    return $mysql;
}

function crud_count($table, $selector=""){
    global $mysql;
    if ($selector!='') $selector = "WHERE ".$selector;
    $sql = "SELECT COUNT(*) as total FROM `$table` ".$selector;
    $sql_result = $mysql -> query($sql);
    $data = [];
    foreach($sql_result as $item){ array_push($data, $item ); }
    return $data[0]['total'];
}

//$users = crud_read('users');
//echo json_encode($users);

//$data['name']="test";
//$data['value']="test_value";
//crud_create('config', $data);

// $data['name']="Иван Иванов";
// $id = 23;
// $selector = "`id` = '$id'";
// crud_update('users', $data, $selector);
// ---- update JSON data
// $data['name']="Иван Иванов";
// $id = 23;
// $selector = "`id` = '$id'";
// $nameCollum = 'data';
// $jsonData['name'] = 'name';
// $jsonData['value'] = 'My name';
// crud_update('users', $data, $selector, $nameCollum, $jsonData);

// $id = 23;
// $selector = "`id` = '$id'";
// crud_delete('users',$selector);


?>