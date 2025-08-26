<?php


    switch ($typeData) {
        case 'tariffs': include '06_tariffs.php'; break;
    }

    if($isLogin){
        switch($typeData){
          case 'beginSubscription' :include '07_beginSubscription.php'; break;  
          case 'deleteSubscription' :include '05_1_subscription_delete_by_user.php'; break;  
        }
    }

    if($isAdmin){
        switch ($typeData) {
            case 'tariffsUpdate': include '08_tariffsUpdate.php'; break;
        }
    }


?>