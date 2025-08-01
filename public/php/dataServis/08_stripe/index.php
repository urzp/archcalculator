<?php


    switch ($typeData) {
        case 'tariffs': include '06_tariffs.php'; break;
    }

    if($isLogin){
        switch($typeData){
          case 'beginSubscription' :include '07_beginSubscription.php'; break;  
        }
    }


?>