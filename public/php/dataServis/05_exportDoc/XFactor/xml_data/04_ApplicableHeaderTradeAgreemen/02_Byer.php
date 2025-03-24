<?php

$customer = $bill-> customer;

$xml->startElementNS('ram', 'BuyerTradeParty', null); 

    $xml->startElementNS('ram', 'ID', null);
        $xml->text('ID_Client'); 
    $xml->endElement();

    $xml->startElementNS('ram', 'Name', null);
        $xml->text($customer->name); 
    $xml->endElement();

    $xml->startElementNS('ram', 'PostalTradeAddress', null);
        $xml->startElementNS('ram', 'PostcodeCode', null);
            $xml->text($customer->postcode); 
        $xml->endElement();
        $xml->startElementNS('ram', 'LineOne', null);
            $xml->text($customer->address); 
        $xml->endElement();
        $xml->startElementNS('ram', 'CityName', null);
            $xml->text($customer->cityName); 
        $xml->endElement();
        $xml->startElementNS('ram', 'CountryID', null);
            $xml->text($customer->CountryID); 
        $xml->endElement();
    $xml->endElement();

$xml->endElement(); 

?>