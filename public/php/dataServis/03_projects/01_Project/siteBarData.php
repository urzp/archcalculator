<?php

$mysql = $mysql_calc;

$selector = "`user_id`='$user_id' AND `status`='calc' ORDER BY  `created`  DESC LIMIT 3";
$collums = " `id`, `name` ,`created` ";
$calcs = crud_read('projects',$collums, $selector);

$selector = "`user_id`='$user_id' AND `status`='offer' ORDER BY  `created`  DESC LIMIT 3";
$collums = " `id`, `name` ,`created` ";
$offers = crud_read('projects',$collums, $selector);

$selector = "`user_id`='$user_id' AND `status`='project' ORDER BY  `created`  DESC LIMIT 3";
$collums = " `id`, `name` ,`created` ";
$projects = crud_read('projects',$collums, $selector);


$result = (object) [
    'success' => true,
    'calcs' => $calcs,
    'offers' => $offers,
    'projects' => $projects,
];

?>