<?php

$downLoad_token = $bill-> downLoad_token;

$xml->startElementNS('ram', 'SellerTradeParty', null); 
        
$xml->startElementNS('ram', 'GlobalID', null);
    $xml->writeAttribute('schemeID', '0002');
    $xml->text($user["GlobalID"]); 
$xml->endElement(); 

$xml->startElementNS('ram', 'Name', null);
    $xml->text($user["name"]); 
$xml->endElement();

$xml->startElementNS('ram', 'DepartmentName', null);
    $xml->text($user["departmentName"]); 
$xml->endElement();     

$xml->startElementNS('ram', 'TelephoneUniversalCommunication', null);
    $xml->startElementNS('ram', 'CompleteNumber', null);
        $xml->text($user["phone"]); 
    $xml->endElement();   
$xml->endElement();    

$xml->startElementNS('ram', 'EmailURIUniversalCommunication', null);
    $xml->startElementNS('ram', 'URIID', null);
        $xml->text($user["email"]); 
    $xml->endElement();   
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

$xml->startElementNS('ram', 'URIUniversalCommunication', null);
    $xml->startElementNS('ram', 'URIID', null);
        $xml->writeAttribute('schemeID', 'EM');
        $xml->text($user["email"]); 
    $xml->endElement(); 
$xml->endElement();        

$xml->startElementNS('ram', 'SpecifiedTaxRegistration', null);
    $xml->startElementNS('ram', 'ID', null);
        $xml->writeAttribute('schemeID', 'FC');
        $xml->text('201/113/40209'); 
    $xml->endElement(); 
$xml->endElement();  

$xml->startElementNS('ram', 'SpecifiedTaxRegistration', null);
    $xml->startElementNS('ram', 'ID', null);
        $xml->writeAttribute('schemeID', 'VA');
        $xml->text('DE123456789'); 
    $xml->endElement(); 
$xml->endElement();  

$xml->endElement(); 

?>