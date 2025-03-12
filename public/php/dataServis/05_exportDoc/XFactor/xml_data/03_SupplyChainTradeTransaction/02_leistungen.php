<?php

$selector = "`id_paragraph` = '$paragraph_id' ORDER BY  cast(`number` as unsigned)  ASC";
$stages = crud_read('Stages',"*", $selector);

$bill_sages = $bill_object -> stages;
$honorar = (float)($bill_object -> honorar_total);
$honorar = number_format($honorar, 2, '.', '');

foreach($stages as $key => $item){
$number = $key + 1;
$p_name = $item['name'];
$percent = $item['percent'];
if(isset($bill_sages[$key])&&$bill_sages[$key]!=''){$percent=$bill_sages[$key];}

$honorar_stage = $honorar*((float)$percent)/100;
$honorar_stage = number_format($honorar_stage, 2, '.', '');

$xml->startElementNS('ram', 'IncludedSupplyChainTradeLineItem', null);

    $xml->startElementNS('ram', 'AssociatedDocumentLineDocument', null);
        $xml->startElementNS('ram', 'LineID', null);
            $xml->text("$num_obj.$number");
        $xml->endElement(); 
    $xml->endElement(); 

    $xml->startElementNS('ram', 'SpecifiedTradeProduct', null);
        $xml->startElementNS('ram', 'Name', null);
            $xml->text($p_name);
        $xml->endElement(); 
    $xml->endElement(); 

    $xml->startElementNS('ram', 'SpecifiedLineTradeDelivery', null);
        $xml->startElementNS('ram', 'BilledQuantity', null);
            $xml->writeAttribute('unitCode', 'C62');
            $xml->text($percent);
        $xml->endElement(); 
    $xml->endElement(); 

    $xml->startElementNS('ram', 'SpecifiedLineTradeAgreement', null);
        $xml->startElementNS('ram', 'GrossPriceProductTradePrice', null);
            $xml->startElementNS('ram', 'ChargeAmount', null);
                $xml->writeAttribute('currencyID', 'EUR');
                $xml->text($honorar);
            $xml->endElement(); 
        $xml->endElement(); 
    $xml->endElement(); 

    $xml->startElementNS('ram', 'SpecifiedTradeSettlementLineMonetarySummation', null);
        $xml->startElementNS('ram', 'LineTotalAmount', null);
            $xml->writeAttribute('currencyID', 'EUR');
            $xml->text($honorar_stage);    
        $xml->endElement();
    $xml->endElement(); 

$xml->endElement(); // Закрываем <ram:IncludedSupplyChainTradeLineItem>

}

?>