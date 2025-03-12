<?php

$additionalServices = $bill -> AdditionalServices;
$number = 0;
$number_main = $num_obj+1;
foreach($additionalServices as $item){

    $number++;

    $name = $item->title;
    $hours = $item ->  hours;
    $price_hours = $item -> price_hours;
    $price_hours = number_format($price_hours, 2, '.', '');

    $sum = (float)$hours*(float)$price_hours;
    $sum = number_format($sum, 2, '.', '');

    $xml->startElementNS('ram', 'IncludedSupplyChainTradeLineItem', null);

        $xml->startElementNS('ram', 'AssociatedDocumentLineDocument', null);
            $xml->startElementNS('ram', 'LineID', null);
                $xml->text("$number_main.$number");
            $xml->endElement(); 
        $xml->endElement(); 

        $xml->startElementNS('ram', 'SpecifiedTradeProduct', null);
            $xml->startElementNS('ram', 'Name', null);
                $xml->text($name);
            $xml->endElement(); 
        $xml->endElement(); 

        $xml->startElementNS('ram', 'SpecifiedLineTradeDelivery', null);
            $xml->startElementNS('ram', 'BilledQuantity', null);
                $xml->writeAttribute('unitCode', 'C62');
                $xml->text($hours);
            $xml->endElement(); 
        $xml->endElement(); 

        $xml->startElementNS('ram', 'SpecifiedLineTradeAgreement', null);
            $xml->startElementNS('ram', 'BilledQuantity', null);
                $xml->startElementNS('ram', 'ChargeAmount', null);
                    $xml->writeAttribute('unitCode', 'NAR');
                    $xml->text($price_hours);
                $xml->endElement(); 
            $xml->endElement(); 
        $xml->endElement(); 

        $xml->startElementNS('ram', 'SpecifiedTradeSettlementLineMonetarySummation', null);
            $xml->startElementNS('ram', 'LineTotalAmount', null);
                $xml->writeAttribute('currencyID', 'EUR');
                $xml->text($sum);    
            $xml->endElement();
        $xml->endElement(); 

    $xml->endElement(); // Закрываем <ram:IncludedSupplyChainTradeLineItem>

}


?>