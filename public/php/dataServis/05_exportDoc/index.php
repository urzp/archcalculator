<?php

if($isLogin){
    $mysql = $mysql_calc;

switch ($typeData) {
    case 'DownloadURL': include 'getDownloadURL.php'; break;
    case 'isAvailableDownload': include 'isAvailableDownload.php'; break;
}

}else{
    
switch ($typeData) {
    case 'isAvailableDownload': include 'isAvailableDownload.php'; break;
}

}

?>