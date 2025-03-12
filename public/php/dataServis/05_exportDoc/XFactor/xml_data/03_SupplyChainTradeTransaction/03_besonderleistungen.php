<?php

$specialServices = $bill_object -> specialServices;

foreach($specialServices as $item){

    $number++;

    $name = $item->title;
    $percent = $item ->  percent;

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
                $xml->text($name);
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