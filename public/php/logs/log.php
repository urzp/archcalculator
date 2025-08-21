<?php

function push_log($text, $scypt_php = '', $log_file = 'log'){
    $log = date('Y-m-d H:i:s').' '.$scypt_php . ' '.$text;
    file_put_contents(__DIR__ . '/'.$log_file.'.txt', $log . PHP_EOL, FILE_APPEND);
}

?>