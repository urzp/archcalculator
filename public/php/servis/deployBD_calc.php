<?php

//$mysql = new mysqli('localhost','ermak8nk_deploy','k%MC0FPpWkhI','ermak8nk_deploy');
$mysql = new mysqli('10.35.233.88:3306','k152370_calc','3n$k91wC5','k152370_calc');


$data['projects'] = "CREATE TABLE projects
(
    id INT(10) PRIMARY KEY AUTO_INCREMENT,
    created datetime CURRENT_TIMESTAMP DEFAULT_GENERATED,
    updated datetime DEFAULT_GENERATED ON UPDATE CURRENT_TIMESTAMP,
    user_id INT(10),
    name varchar(300),
)";

$data['objects'] = "CREATE TABLE objects
(
    id INT(10) PRIMARY KEY AUTO_INCREMENT,
    created datetime CURRENT_TIMESTAMP DEFAULT_GENERATED,
    updated datetime DEFAULT_GENERATED ON UPDATE CURRENT_TIMESTAMP,
    user_id INT(10),
    project_id INT(10),
    name varchar(100),
    HOAI_version_id: INT(10),
    paragraph_id: INT(10),
    honorarLevel_id INT(10),
    usePoints varchar(10),
    requirementsPoints varchar(100),
    requirementsPointsNames varchar(500),
)";

$data['paragraph'] = "CREATE TABLE paragraph
(
    id INT(10) PRIMARY KEY AUTO_INCREMENT,
    created datetime CURRENT_TIMESTAMP DEFAULT_GENERATED,
    updated datetime DEFAULT_GENERATED ON UPDATE CURRENT_TIMESTAMP,
    user_id INT(10),
    object_id INT(10),
    paragraph_id INT(10),
    honorarLevel_id INT(10),
    usePoints varchar(10),
    requirementsPoints varchar(100),
    requirementsPointsNames varchar(500),
)";





foreach($data as $item){
    $mysql -> query($item);
}

?>