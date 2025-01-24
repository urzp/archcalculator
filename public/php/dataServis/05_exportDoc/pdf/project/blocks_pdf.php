<?php

function toMoney($value){
    $result = '';
    $result = number_format($value, 2).' €';
    $result = str_replace(',', ' ', $result);
    $result = str_replace('.', ',', $result);
    return $result;
}

function toFormat($value, $sumbol=""){
    $result = '';
    $result = number_format($value, 2).$sumbol;
    $result = str_replace(',', ' ', $result);
    $result = str_replace('.', ',', $result);
    return $result;
}

function render_objects($objects){
    global $billData;
    $result = '';
    foreach($objects as $index => $obj){
        $index_leter = number_to_leter($index + 1);
        $cost = toMoney($obj -> costs);
        $honorar_total = toMoney($obj -> honorar_total);
        $obj_total = toMoney($obj -> total);
        $result .= "
        <div class='content_left_right object_title bold'>
            <div class='left'> $index_leter Honorarobjekt </div>
            <div class='right'>{$obj->name}</div>
        </div>
        <div class='content_left_right object_base_servis'>
            <div class='left'>1. Honorarzone und Honorarsatz </div>
            <div class='right'>{$obj -> honorar_zone} {$obj -> honorar_satz}</div>
        </div>
        <div class='content_left_right object_base_servis'>
            <div class='left'>2. Anrechenbaren Kosten </div>
            <div class='right'>{$cost}</div>
        </div>
        <div class='content_left_right object_base_servis'>
            <div class='left'>3. Rechnerisches Gesamthonorar </div>
            <div class='right'>{$honorar_total}</div>
        </div>
        <div class='object_base_servis'>4. Ermittlung Leistungsstand</div>
        <div class='row_gap'></div>";
        $result .= base_servis_obj($obj);
        $result .= extra_servis_obj($obj);
        $result .= "
        <div class='row_gap'></div>
        <div class='content_left_right object_base_servis'>
            <div class='left bold'>Summ as Honorarobjekt</div>
            <div class='right bold'>{$obj_total}</div>
        </div>
        <div class='row_gap'></div>
        ";
    }
    if(count($objects) > 1){
        $total_objects =toMoney($billData -> total_objects);
        $result .= "
        <div class='row_gap'></div>
        <div class='content_left_right object_base_servis'>
            <div class='left bold'>Summ as alles Honorarobjekt</div>
            <div class='right bold'>{$total_objects}</div>
        </div>
        <div class='row_gap'></div>
        ";        
    };
    return $result;
}

function base_servis_obj($obj){
    $result = "
    
    <table class='base_servis table_header' style='width: 650px;'>
        <tr>
            <th style='width: 45%; text-align: left;'>Leistungsphase</th>
            <th style='width: 9%;'>beauftragt</th>
            <th style='width: 9%;'>geleistet</th>
            <th style='width: 8%;'>Faktor</th>
            <th style='width: 14%;'></th>
            <th style='width: 14%;'></th>
        </tr>
    </table>

    ";

    foreach($obj->stages as $i => $item){
        $percent = toFormat($item -> percent, "%");
        $done = toFormat($item -> done, "%");
        $factor = toFormat($item -> factor);
        $total = toMoney($item -> total);
        $result .="
        <table class='base_servis' style='width: 650px;'>
            <tr>
                <td style='width: 45%; text-align: left;'>{$item -> name}</td>
                <td style='width: 9%; text-align: right;'>{$percent}</td>
                <td style='width: 9%; text-align: right;'>{$done}</td>
                <td style='width: 8%; text-align: right;'>{$factor}</td>
                <td style='width: 14%; text-align: right;'>{$total}</td>
                <td style='width: 14%;'></td>
            </tr>
        </table>
        ";
    }
    $i++;
    $total = $obj->stages_total;
    $percent = toFormat($total -> percent, "%");
    $done = toFormat($total -> done, "%");
    $price = toMoney($total -> price);
    $result .="
    <table class='base_servis summ line' style='width: 650px;'>
        <tr>
            <td style='width: 45%; text-align: left;'>Summe aus $i</td>
            <td style='width: 9%; text-align: right;'>{$percent}</td>
            <td style='width: 9%; text-align: right;'>{$done}</td>
            <td style='width: 8%; text-align: right;'></td>
            <td style='width: 14%; text-align: right;'></td>
            <td style='width: 14%; text-align: right;'>{$price}</td>
        </tr>
    </table>
    ";

    return $result;
}

function extra_servis_obj( $obj){
    $result = "
        <div class='row_gap'></div>
        <div class='object_base_servis'>5. Ermittlung Leistungsstand</div>
        <div class='row_gap'></div>

        <table class='base_servis table_header' style='width: 650px;'>
            <tr>
                <th style='width: 45%; text-align: left;'>Sonderleistungen</th>
                <th style='width: 9%;'></th>
                <th style='width: 9%;'></th>
                <th style='width: 8%;'></th>
                <th style='width: 14%;'></th>
                <th style='width: 14%;'></th>
            </tr>
        </table>
    ";
    if( count($obj -> stagesExtra) == 0 ) return '';

    foreach($obj->stagesExtra as $i => $item){
        $percent = toFormat($item -> percent, "%");
        $total = toMoney($item -> total);
        $result .="
        <table class='base_servis' style='width: 650px;'>
            <tr>
                <td style='width: 45%; text-align: left;'>{$item -> title}</td>
                <td style='width: 9%; text-align: right;'></td>
                <td style='width: 9%; text-align: right;'>{$percent}</td>
                <td style='width: 8%; text-align: right;'></td>
                <td style='width: 14%; text-align: right;'>{$total}</td>
                <td style='width: 14%;'></td>
            </tr>
        </table>
        ";        
    }
    $i++;
    $total = $obj->stages_total;
    $price = toMoney($obj -> stagesExtraTotal);
    $result .="
    <table class='base_servis summ line' style='width: 650px;'>
        <tr>
            <td style='width: 45%; text-align: left;'>Summe aus $i</td>
            <td style='width: 9%; text-align: right;'></td>
            <td style='width: 9%; text-align: right;'></td>
            <td style='width: 8%; text-align: right;'></td>
            <td style='width: 14%; text-align: right;'></td>
            <td style='width: 14%; text-align: right;'>{$price}</td>
        </tr>
    </table>
    ";
    
    return $result;
}

function render_extra_servis($billData){
    $result = '';
    if( count($billData->extraServis) == 0 ) return '';
    foreach($billData->extraServis as $i => $item){
        $hours = toFormat($item -> hours, ' h');
        $price_hours = toFormat($item -> price_hours, ' €h');
        $total = toMoney($item -> total);
        $result .="
        <table class='extra_servis' style='width: 690px;'>
            <tr>
                <td style='width: 45%; text-align: left;'>{$item -> title}</td>
                <td style='width: 6%; text-align: right;'></td>
                <td style='width: 9%; text-align: right;'>{$hours}</td>
                <td style='width: 12%; text-align: right;'>{$price_hours}</td>
                <td style='width: 14%; text-align: right;'>{$total}</td>
                <td style='width: 14%;'></td>
            </tr>
        </table>
        ";         
    }

    $i++;
    $price = toMoney($billData -> totalExtraServis);
    $result .="
    <table class='extra_servis summ' style='width: 690px;'>
        <tr>
            <td style='width: 45%; text-align: left;'>Summe aus $i</td>
            <td style='width: 9%; text-align: right;'></td>
            <td style='width: 9%; text-align: right;'></td>
            <td style='width: 8%; text-align: right;'></td>
            <td style='width: 14%; text-align: right;'></td>
            <td style='width: 14%; text-align: right;'>{$price}</td>
        </tr>
    </table>
    <div class='row_gap'></div>
    ";
    return $result;
}

function render_extraCosts($billData){
    $result = '';
    if( count($billData->extraCosts) == 0 ) return '';
    foreach($billData->extraCosts as $i => $item){
        $rate = toFormat($item -> rate);
        $price_rate = toFormat($item -> price_rate);
        $total = toMoney($item -> total);
        $result .="
        <table class='extra_servis' style='width: 690px;'>
            <tr>
                <td style='width: 45%; text-align: left;'>{$item -> title}</td>
                <td style='width: 6%; text-align: right;'></td>
                <td style='width: 9%; text-align: right;'>{$rate}</td>
                <td style='width: 12%; text-align: right;'>{$price_rate}</td>
                <td style='width: 14%; text-align: right;'>{$total}</td>
                <td style='width: 14%;'></td>
            </tr>
        </table>
        ";         
    }

    $i++;
    $price = toMoney($billData -> totalExtraCosts);
    $result .="
    <table class='extra_servis summ' style='width: 690px;'>
        <tr>
            <td style='width: 45%; text-align: left;'>Summe aus $i</td>
            <td style='width: 9%; text-align: right;'></td>
            <td style='width: 9%; text-align: right;'></td>
            <td style='width: 8%; text-align: right;'></td>
            <td style='width: 14%; text-align: right;'></td>
            <td style='width: 14%; text-align: right;'>{$price}</td>
        </tr>
    </table>
    <div class='row_gap'></div>
    ";
    return $result;
}

function render_totalProject($billData){
    $result = '';
    $total_net = toMoney($billData->total_net);
    $tax = toMoney($billData->tax);
    $total_tax = toMoney($billData->total_tax); 
    $total = toMoney($billData->total);
    $result .="
    <table class='total_project' style='width: 690px;'>
        <tr>
            <td class='bold' style='width: 75%; text-align: left;'>1. Zwischensumme Netto-Honorare einschließlich Nebenkosten</td>
            <td class='bold' style='width: 10%; text-align: right;'></td>
            <td class='bold' style='width: 15%; text-align: right;'>{$total_net}</td>
        </tr>
        <tr>
            <td class='bold' style='width: 75%; text-align: left;'>2. Umsatzsteuer</td>
            <td class='bold' style='width: 10%; text-align: right;'>{$tax}</td>
            <td class='bold' style='width: 15%; text-align: right;'>{$total_tax}</td>
        </tr>
        <tr>
            <td class='bold' style='width: 75%; text-align: left;'>3. Brutto-Honorar einschließlich Nebenkosten</td>
            <td class='bold' style='width: 10%; text-align: right;'></td>
            <td class='bold' style='width: 15%; text-align: right;'>{$total}</td>
        </tr>
    </table>
    <div class='row_gap'></div>
    ";   

    return $result;
}

function render_payments($billData){
    $result = "";
    $total = toMoney($billData->total);
    $total_rest = toMoney($billData->total_rest);
    $result .="
    <table class='total_project' style='width: 690px;'>
        <tr>
            <td style='width: 75%; text-align: left;'>1. Rechnerisches Gesamthonorar</td>
            <td style='width: 10%; text-align: right;'></td>
            <td style='width: 15%; text-align: right;'>{$total}</td>
        </tr>
        <tr>
            <td style='width: 75%; text-align: left;'>2. Abzüge für geleistete Abschlagszahlungen</td>
            <td style='width: 10%; text-align: right;'></td>
            <td style='width: 15%; text-align: right;'></td>
        </tr>
    </table>
    ";    
    $result .="<table class='base_servis' style='width: 650px;'>";
    $summ = 0;
    foreach ($billData->paid->previous as $index => $item){
        $summ=$summ+$item->value;
        $date =  date('d.m.Y',strtotime($item->date));
        $total = toMoney($item->value);
        $result .="
            <tr>
                <td style='width: 30%; text-align: left;'>{$item->invoice_number}</td>
                <td style='width: 10%; text-align: right;'></td>
                <td style='width: 15%; text-align: right;'>{$date}</td>
                <td style='width: 15%; text-align: right;'>Zahlung vom</td>
                <td style='width: 15%; text-align: right;'>{$total}</td>
                <td style='width: 15%;'></td>
            </tr>
        ";
    }

    $summ=$summ*(-1);
    $summ = toMoney($summ);
    $result .="
        <tr>
            <td style='width: 30%; text-align: left;'>Summe</td>
            <td style='width: 10%; text-align: right;'></td>
            <td style='width: 15%; text-align: right;'></td>
            <td style='width: 15%; text-align: right;'></td>
            <td style='width: 15%; text-align: right;'></td>
            <td style='width: 15%; text-align: right;'>{$summ}</td>
        </tr>
    ";
    $result .="</table>";

    $result .="
    <table class='total_project' style='width: 690px;'>
        <tr>
            <td style='width: 75%; text-align: left;'>3. Restlicher Honoraranspruch</td>
            <td style='width: 10%; text-align: right;'></td>
            <td style='width: 15%; text-align: right;'>{$total_rest}</td>
        </tr>
    </table>
    <div class='row_gap'></div>
    ";        
    return $result;
}

?>