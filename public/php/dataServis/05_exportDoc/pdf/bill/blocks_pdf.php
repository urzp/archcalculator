<?php

//---------------------------------------------- objects --------------------------------------------------

$objects_html='';

foreach($objects as $item){
    $name_obj = $item->name;
    $total_object = toMoney($item->total_object);
    $honorar_total = toMoney($item->honorar_total);
    $servis_total = toMoney($item->servis_total); 
    $spetial_servis_total = toMoney($item->spetial_servis_total);  

    

    $id = $item->HOAI_version_id; 
    $selector_HOAI = "`id`='$id'";
    $mysql = $mysql_HOAI;
    $HOAI = crud_read('HOAI_versions',"value", $selector_HOAI)[0]['value'];

    $id = $item->paragraph_id; $selector_paragraph = "`id`='$id'";
    $paragraph = crud_read('paragraphs',"name, title", $selector_paragraph)[0];
    $paragraph = $paragraph['name']." ".$paragraph['title'];
    $honorarzone = $item->honorarLevel->value;

    $honorarRate = $item->HonorarRate->value;
    $finance = toMoney($item->finance->value);
    $honorar_calc = toMoney($item->honorar_calc);
    $payExtra = toMoney($item->payExtra->value);
    $payExtraPercent = toFormat($item->payExtra->percent, '%');


    // //............................................ stages ....................................................

    $stages_html ="";

    $id = $item->paragraph_id; $selector_stages = "`id_paragraph`='$id' ORDER BY  cast(`number` as unsigned)  ASC";
    $stages = crud_read('Stages',"*", $selector_stages);
    $summ_percent_stages = 0;

    $mysql = $mysql_calc;

    foreach($stages as $key=>$item_stage){
        $name = $item_stage['name'];
        $value_default = $item_stage['percent'];
        if(isset($item ->stages)){
            if($item->stages[$key]=='') {$value = $value_default;} else {$value = $item->stages[$key];}
        }else{
            $value = $value_default;
        }
        $summ_percent_stages+=(float)$value;
        $summ_item = $item->honorar_calc * $value/100;

        $value_default = toFormat($value_default, '%');
        $value = toFormat($value, '%');
        $summ_item = toMoney($summ_item);

        $stages_html.="
            <tr>
                <td class='title_3' style='width: 50%; padding-left: 20px; text-align: left;'>$name</td>
                <td class='title_3 number' style='width: 11%; text-align: right;'>$value_default</td>
                <td class='title_3 number' style='width: 11%; text-align: right;'>$value</td>
                <td class='title_3 number' style='width: 18%; text-align: right;'>$summ_item</td>
            </tr>";
    }

    //........................................... specialServices .................................................

    $stages_html ="<table class='row_style' style='width: 680px;'>".$stages_html;
    $stages_html.="</table>";


    $spetial_servis_html ="";

    $spetial_servis = $item->specialServices;
    foreach($spetial_servis as $item_servis){
        $name = $item_servis->title;
        $percent = $item_servis->percent;
        $price = $item->honorar_calc*$percent/100;
        $percent = toFormat($percent, '%');
        $price = toMoney($price);
        $spetial_servis_html.="
            <tr>
                <td class='title_3' style='width: 50%; padding-left: 20px; text-align: left;'>$name</td>
                <td class='title_3 number' style='width: 25%; text-align: right;'>$percent</td>
                <td class='title_3 number' style='width: 25%; text-align: right;'>$price</td>
            </tr>
        ";

    }

    $spetial_servis_html ="<table class='row_style' style='width: 680px;'>".$spetial_servis_html;
    $spetial_servis_html.="</table>";

    $objects_html.="
    <div class='title_1 summe_title'>$name_obj</div>
    <div class='summ_wrap'>
        <div class='title_2'>Honorargrundlagen</div>
        <table class='row_style' style='width: 680px;'>
            <tr>
                <td class='title_3' style='width: 50%; padding-left: 20px; text-align: left;'>HOAI Version</td>
                <td class='title_3' style='width: 25%; text-align: right;'></td>
                <td class='title_3' style='width: 25%; text-align: right;'>$HOAI</td>
            </tr>
            <tr>
                <td class='title_3' style='width: 50%; padding-left: 20px; text-align: left;'>Planungsgegenstand</td>
                <td class='title_3' style='width: 25%; text-align: left;'></td>
                <td class='title_3' style='width: 25%; text-align: right;'>$paragraph</td>
            </tr>
            <tr>
                <td class='title_3' style='width: 50%; padding-left: 20px; text-align: left;'>Honorarzone</td>
                <td class='title_3' style='width: 25%; text-align: left;'></td>
                <td class='title_3' style='width: 25%; text-align: right;'>$honorarzone</td>
            </tr>
            <tr>
                <td class='title_3' style='width: 50%; padding-left: 20px; text-align: left;'>Honorarsatz</td>
                <td class='title_3' style='width: 25%; text-align: left;'></td>
                <td class='title_3' style='width: 25%; text-align: right;'>$honorarRate</td>
            </tr>
            <tr>
                <td class='title_3' style='width: 50%; padding-left: 20px; text-align: left;'>Anrechenbare Kosten</td>
                <td class='title_3' style='width: 25%; text-align: left;'></td>
                <td class='title_3 number' style='width: 25%; text-align: right;'>$finance</td>
            </tr>
            <tr>
                <td class='title_3' style='width: 50%; padding-left: 20px; text-align: left;'>Honorar nach Honorartafel</td>
                <td class='title_3' style='width: 25%; text-align: left;'></td>
                <td class='title_3 number' style='width: 25%; text-align: right;'>$honorar_calc</td>
            </tr>
            <tr>
                <td class='title_3' style='width: 50%; padding-left: 20px; text-align: left;'>Zuschlag</td>
                <td class='title_3 number' style='width: 25%; text-align: right;'>$payExtraPercent</td>
                <td class='title_3 number' style='width: 25%; text-align: right;'>$payExtra</td>
            </tr>
        </table>

        <div class='title_3 number' style='width: 640px; text-align: right;'>Summe:  $honorar_total</div>
        <div class='title_2'>Leistungen</div>";
$objects_html.= $stages_html;
$objects_html.="  
        <div class='title_3 number' style='width: 640px; text-align: right;'>Summe: $summ_percent_stages%   $servis_total</div>

        <div class='title_2'>Besondere Leistungen</div>";
$objects_html.= $spetial_servis_html;
$objects_html.=" 
        <div class='title_3 number' style='width: 640px; text-align: right;'>Summe:  $spetial_servis_total</div>
        <div class='total_object'>
            <div class='title_1'>$name_obj</div>
            <div class='title_1 number-bold total_project_Summe'>Summe: $total_object </div>
        </div>
    </div>
    ";
}


//---------------------------------------------- summ project --------------------------------------------------

$project_AdditionalServices = $project->AdditionalServices;

$project_AdditionalServices_html = '';

foreach($project_AdditionalServices as $item){
    $title = $item->title;
    $type_rate = $item->type_rate;
    $price_type_rate = $type_rate=='%'?'€':'€/'.$type_rate;
    $rate = toFormat($item->rate, $type_rate);
    $price_rate = toMoney($item->price_rate, $price_type_rate);
    $summ = $item->summ;
    $summ = toMoney($summ);
    
    $project_AdditionalServices_html .= "
    <tr>
        <td class='title_3' style='width: 50%; padding-left: 20px; text-align: left;'>$title</td>
        <td class='title_3 number' style='width: 16.6%; text-align: right;'>$rate</td>
        <td class='title_3 number' style='width: 16.6%; text-align: right;'>$price_rate</td>
        <td class='title_3 number' style='width: 16.6%; text-align: right;'>$summ</td>
    </tr>    
    ";
}

if(count($project_AdditionalServices)>0){
    $project_AdditionalServices_html = "<table class='row_style' style='width: 680px;'>".$project_AdditionalServices_html; 
    $project_AdditionalServices_html.= "</table>";
}
$project_total_AdditionalServices=toMoney($project->total_AdditionalServices);   
$project_AdditionalServices_html.="<div class='title_3 number' style='width: 640px; text-align: right;'>Summe Zusätzliche Leistungen:  $project_total_AdditionalServices</div>";


$project_ExtraCosts = $project->ExtraCosts;

$project_ExtraCosts_html = '';

foreach($project_ExtraCosts as $item){
    $title = $item->title;
    $type_rate = $item->type_rate;
    $price_type_rate = $type_rate=='%'?'€':'€/'.$type_rate;
    $rate = toFormat($item->rate, $type_rate);
    $price_rate = toMoney($item->price_rate, $price_type_rate);
    $summ = $item->summ;
    $summ = toMoney($summ);
    
    $project_ExtraCosts_html .= "
    <tr>
        <td class='title_3' style='width: 50%; padding-left: 20px; text-align: left;'>$title</td>
        <td class='title_3 number' style='width: 16.6%; text-align: right;'>$rate</td>
        <td class='title_3 number' style='width: 16.6%; text-align: right;'>$price_rate</td>
        <td class='title_3 number' style='width: 16.6%; text-align: right;'>$summ</td>
    </tr>    
    ";
}

if(count($project_ExtraCosts)>0){
    $project_ExtraCosts_html = "<table class='row_style' style='width: 680px;'>".$project_ExtraCosts_html; 
    $project_ExtraCosts_html.= "</table>";
}
$project_total_ExtraCosts=toMoney($project->total_ExtraCosts);   
$project_ExtraCosts_html.="<div class='title_3 number' style='width: 640px; text-align: right;'>Summe der Nebenkosten:  $project_total_ExtraCosts</div>";



?>