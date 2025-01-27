<?php

//---------------------------------------------- objects --------------------------------------------------

$objects_html='';

foreach($objects as $item){
    $name = $item['name'];
    $total_object = toMoney($item['total_object']);

    $objects_html.="
    <div class='title_1 summe_title'>$name</div>
    <div class='summ_wrap'>
        <div class='title_2'>Honorargrundlagen</div>
        <div class='title_2'>Leistungen</div>
        <div class='title_2'>Besondere Leistungen</div>
        <div class='total_object'>
            <div class='title_1'>$name</div>
            <div class='title_1 total_project_Summe'>Summe: $total_object </div>
        </div>
    </div>
    ";
}


//---------------------------------------------- summ project --------------------------------------------------

$project_AdditionalServices = $project['AdditionalServices'];

$project_AdditionalServices_html = '';

foreach($project_AdditionalServices as $item){
    $title = $item->title;
    $hours = toFormat($item->hours, 'h');
    $price_hours = toFormat($item->price_hours, '€/h');
    $summ = $item->hours * $item->price_hours;
    $summ = toMoney($summ);
    
    $project_AdditionalServices_html .= "
    <tr>
        <td class='title_3' style='width: 50%; padding-left: 20px; text-align: left;'>$title</td>
        <td class='title_3' style='width: 16.6%; text-align: left;'>$hours</td>
        <td class='title_3' style='width: 16.6%; text-align: right;'>$price_hours</td>
        <td class='title_3' style='width: 16.6%; text-align: right;'>$summ</td>
    </tr>    
    ";
}

if(count($project_AdditionalServices)>0){
    $project_AdditionalServices_html = "<table class='row_style' style='width: 680px;'>".$project_AdditionalServices_html; 
    $project_AdditionalServices_html.= "</table>";
}
$project_total_AdditionalServices=toMoney($project['total_AdditionalServices']);   
$project_AdditionalServices_html.="<div class='title_3' style='width: 640px; text-align: right;'>Summe Zusätzliche Leistungen:  $project_total_AdditionalServices</div>";


$project_ExtraCosts = $project['ExtraCosts'];

$project_ExtraCosts_html = '';

foreach($project_ExtraCosts as $item){
    $title = $item->title;
    $rate = toFormat($item->rate, '');
    $price_rate = toFormat($item->price_rate, '');
    $summ = $item->rate * $item->price_rate;
    $summ = toMoney($summ);
    
    $project_ExtraCosts_html .= "
    <tr>
        <td class='title_3' style='width: 50%; padding-left: 20px; text-align: left;'>$title</td>
        <td class='title_3' style='width: 16.6%; text-align: left;'>$rate</td>
        <td class='title_3' style='width: 16.6%; text-align: right;'>$price_rate</td>
        <td class='title_3' style='width: 16.6%; text-align: right;'>$summ</td>
    </tr>    
    ";
}

if(count($project_ExtraCosts)>0){
    $project_ExtraCosts_html = "<table class='row_style' style='width: 680px;'>".$project_ExtraCosts_html; 
    $project_ExtraCosts_html.= "</table>";
}
$project_total_ExtraCosts=toMoney($project['total_ExtraCosts']);   
$project_ExtraCosts_html.="<div class='title_3' style='width: 640px; text-align: right;'>Summe der Nebenkosten:  $project_total_ExtraCosts</div>";



?>