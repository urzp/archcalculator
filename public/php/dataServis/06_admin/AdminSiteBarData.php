<?php

$mysql = $mysql_calc;

$users = crud_count('users');
$projects = crud_count('projects');
$bills = crud_count('project_bills');
$tariffs = crud_count('tariffs');

$mysql = $mysql_HOAI;
$HOAI_versions = crud_count('HOAI_versions');

$result = (object) [
    'success' => true,
    'users' => $users,
    'projects' => $projects,
    'bills' => $bills,
    'HOAI_versions'=> $HOAI_versions,
    'tariffs' => $tariffs,
];

?>