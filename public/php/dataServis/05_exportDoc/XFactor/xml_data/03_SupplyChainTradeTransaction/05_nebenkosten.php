<?php

$additionalServices = $bill -> ExtraCosts;
$number = 0;
$number_main = $num_obj+2;
foreach($additionalServices as $item){

    $number++;

    $name = $item->title;
    $rate = $item ->  rate;
    $price_rate = $item -> price_rate;
    $price_rate = number_format($price_rate, 2, '.', '');

    $sum = (float)$rate*(float)$price_rate;
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
                $xml->text($rate);
            $xml->endElement(); 
        $xml->endElement(); 

        $xml->startElementNS('ram', 'SpecifiedLineTradeAgreement', null);
            $xml->startElementNS('ram', 'BilledQuantity', null);
                $xml->startElementNS('ram', 'ChargeAmount', null);
                    $xml->writeAttribute('unitCode', 'EUR');
                    $xml->text($price_rate);
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