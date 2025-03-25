<?php

$downLoad_token = $bill-> downLoad_token;

$xml->startElementNS('ram', 'SellerTradeParty', null); 
        
$xml->startElementNS('ram', 'ID', null);
    $xml->text($user["GlobalID"]); 
$xml->endElement(); 

$xml->startElementNS('ram', 'Name', null);
    $xml->text($user["name"]); 
$xml->endElement();

$xml->startElementNS('ram', 'Description', null);
    $xml->text($user["departmentName"]); 
$xml->endElement();       

$xml->startElementNS('ram', 'PostalTradeAddress', null);
    $xml->startElementNS('ram', 'PostcodeCode', null);
        $xml->text($user["postcode"]); 
    $xml->endElement();   
    $xml->startElementNS('ram', 'LineOne', null);
        $xml->text($user["address"]); 
    $xml->endElement();
    $xml->startElementNS('ram', 'CityName', null);
        $xml->text($user["cityName"]); 
    $xml->endElement();
    $xml->startElementNS('ram', 'CountryID', null);
        $xml->text($user["countryID"]); 
    $xml->endElement();
$xml->endElement();    

$xml->startElementNS('ram', 'SpecifiedTaxRegistration', null);
    $xml->startElementNS('ram', 'ID', null);
        $xml->writeAttribute('schemeID', 'VA');
        $xml->text($user["USt"]); 
    $xml->endElement(); 
$xml->endElement();  

$xml->endElement(); 

?>