<?php

//$mysql = new mysqli('localhost','ermak8nk_deploy','k%MC0FPpWkhI','ermak8nk_deploy');
$mysql = new mysqli('10.35.233.88:3306','k152370_HOAI','E44rf&7k4','k152370_HOAI');

$data['HOAI_versions'] = "CREATE TABLE HOAI_versions
(
    id INT(10) PRIMARY KEY AUTO_INCREMENT,
    value VARCHAR(30),
    sequence VARCHAR(50)
)";

$data['paragraphs'] = "CREATE TABLE paragraphs 
(
    id int(50) PRIMARY KEY AUTO_INCREMENT,
    id_HOAI int(50),
    paragraph varchar(50),
    name varchar(200),
    title varchar(300),
    link_basis varchar(500),
    link_fee varchar(500),
    sequence varchar(50),
    comment varchar(300),
    link_basic_services varchar(500),
    link_special_services varchar(500)
)";

$data['allowableCosts'] = "CREATE TABLE allowableCosts
(
    id int(50) PRIMARY KEY AUTO_INCREMENT,
    id_paragraph int(50),
    number varchar(5),
    name varchar(100),
)";

$data['feeTableHonorarZones'] = "CREATE TABLE feeTableHonorarZones
(
    id int(50) PRIMARY KEY AUTO_INCREMENT,
    id_paragraph int(50),
    number varchar(5),
    name varchar(100),
    maxPoint varchar(10)
)";

$data['feeTableHonorarZonesRateValue'] = "CREATE TABLE feeTableHonorarZonesRateValue
(
    id int(50) PRIMARY KEY AUTO_INCREMENT,
    id_feeTableRateValue int(50),
    id_feeTableHonorarZones int(50),
    value varchar(100)
)";

$data['feeTableRateValue'] = "CREATE TABLE feeTableRateValue
(
    id int(50) PRIMARY KEY AUTO_INCREMENT,
    id_paragraph int(50),
    number varchar(5),
    value varchar(100)
)";

$data['feeTableTypeValue'] = "CREATE TABLE feeTableTypeValue
(
    id int(50) PRIMARY KEY AUTO_INCREMENT,
    id_paragraph int(50),
    number varchar(5),
    value varchar(100)
)";

$data['requirementsPoints'] = "CREATE TABLE requirementsPoints
(
    id int(50) PRIMARY KEY AUTO_INCREMENT,
    id_paragraph int(50),
    number varchar(5),,
    name varchar(250),
    minPoint varchar(10),
    maxPoint varchar(10),
    value varchar(100)
)";

$data['Stages'] = "CREATE TABLE Stages
(
    id int(50) PRIMARY KEY AUTO_INCREMENT,
    id_paragraph int(50),
    number varchar(5),
    name varchar(300),
    percent varchar(50)
)";

$data['subStage'] = "CREATE TABLE subStage
(
    id int(50) PRIMARY KEY AUTO_INCREMENT,
    id_stage int(50),
    number varchar(5),
    name varchar(500),
    percent varchar(50)
)";

$data['subStage_l1'] = "CREATE TABLE subStage_l1
(
    id int(50) PRIMARY KEY AUTO_INCREMENT,
    id_subStage int(50),
    number varchar(5),
    name varchar(500),
    percent varchar(50)
)";



foreach($data as $item){
    $mysql -> query($item);
}

?>