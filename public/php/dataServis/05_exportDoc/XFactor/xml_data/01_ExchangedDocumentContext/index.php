<?php

$xml->startElementNS('rsm', 'ExchangedDocumentContext', null);

$xml->startElementNS('ram', 'BusinessProcessSpecifiedDocumentContextParameter', null);
$xml->startElementNS('ram', 'ID', null);
$xml->text('urn:fdc:peppol.eu:2017:poacc:billing:01:1.0'); 
$xml->endElement(); 
$xml->endElement(); 

$xml->startElementNS('ram', 'GuidelineSpecifiedDocumentContextParameter', null);
$xml->startElementNS('ram', 'ID', null);
$xml->text('urn:factur-x.eu:1p0:en16931'); 
$xml->endElement(); 
$xml->endElement(); 

$xml->endElement(); 

?>
