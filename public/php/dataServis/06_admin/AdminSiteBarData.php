<?php

$mysql = $mysql_calc;

$users = crud_count('users');

// $selector = "`user_id`='$user_id' AND `status`='offer' ORDER BY  `created`  DESC LIMIT 3";
// $collums = " `id`, `name` ,`created` ";
// $offers = crud_read('projects',$collums, $selector);

// $selector = "`user_id`='$user_id' AND `status`='project' ORDER BY  `created`  DESC LIMIT 5";
// $collums = " `id`, `name` ,`created` ";
// $projects = crud_read('projects',$collums, $selector);


$result = (object) [
    'success' => true,
    'users' => $users,
];

?>