<?php

$mysql = $mysql_calc;

$users = crud_count('users');
$projects = crud_count('projects');

$mysql = $mysql_HOAI;
$HOAI_versions = crud_count('HOAI_versions');

$result = (object) [
    'success' => true,
    'users' => $users,
    'projects' => $projects,
    'HOAI_versions'=> $HOAI_versions,
];

?>