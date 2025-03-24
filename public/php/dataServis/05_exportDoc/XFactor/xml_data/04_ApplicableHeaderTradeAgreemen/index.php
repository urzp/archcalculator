<?php

$xml->startElementNS('ram', 'ApplicableHeaderTradeAgreement', null);

    $xml->startElementNS('ram', 'BuyerReference', null); 
        $xml->text($downLoad_token); 
    $xml->endElement(); 

    include '01_Seller.php';
    include '02_Byer.php';

    $xml->startElementNS('ram', 'SellerOrderReferencedDocument', null); 
        $xml->startElementNS('ram', 'IssuerAssignedID', null); 
            $xml->text($bill->id_project_contract); 
        $xml->endElement(); 
    $xml->endElement(); 

    $xml->startElementNS('ram', 'SpecifiedProcuringProject', null); 
        $xml->startElementNS('ram', 'ID', null); 
            $xml->text($bill->id); 
        $xml->endElement(); 
        $xml->startElementNS('ram', 'Name', null); 
            $xml->text($bill->name); 
        $xml->endElement(); 
    $xml->endElement(); 


$xml->endElement(); 


?>