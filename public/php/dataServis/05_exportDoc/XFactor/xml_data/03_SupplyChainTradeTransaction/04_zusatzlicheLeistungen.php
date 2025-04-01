<?php

$additionalServices = $bill -> AdditionalServices;
$number = 0;
$number_main = $num_obj+1;
foreach($additionalServices as $item){

    $number++;

    $name = $item->title;
    $hours = $item->rate;
    $hours = number_format($hours, 2, '.', '');
    $price_rate = $item -> price_rate;
    $price_rate = number_format($price_rate, 2, '.', '');

    $sum = $item->summ;
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

        $xml->startElementNS('ram', 'SpecifiedLineTradeAgreement', null);
            $xml->startElementNS('ram', 'NetPriceProductTradePrice', null);
                $xml->startElementNS('ram', 'ChargeAmount', null);
                    $xml->text($price_rate);
                $xml->endElement(); 
            $xml->endElement(); 
        $xml->endElement(); 

        $xml->startElementNS('ram', 'SpecifiedLineTradeDelivery', null);
            $xml->startElementNS('ram', 'BilledQuantity', null);
                $xml->writeAttribute('unitCode', 'HUR');
                $xml->text($hours);
            $xml->endElement(); 
        $xml->endElement(); 

        $xml->startElementNS('ram', 'SpecifiedLineTradeSettlement', null);
            $xml->startElementNS('ram', 'ApplicableTradeTax', null);
                $xml->startElementNS('ram', 'TypeCode', null);
                    $xml->text('VAT');
                $xml->endElement();
                $xml->startElementNS('ram', 'CategoryCode', null);
                    $xml->text('S');
                $xml->endElement();
                $xml->startElementNS('ram', 'RateApplicablePercent', null);
                    $xml->text($Tax);
                $xml->endElement();
            $xml->endElement();
            $xml->startElementNS('ram', 'SpecifiedTradeSettlementLineMonetarySummation', null);
                $xml->startElementNS('ram', 'LineTotalAmount', null);
                    $xml->writeAttribute('currencyID', 'EUR');
                    $xml->text($sum);    
                $xml->endElement();    
            $xml->endElement();
        $xml->endElement();

    $xml->endElement(); 

}


?>