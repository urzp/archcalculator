<?php
//https://honorar.online/php/dataServis/05_exportDoc/XFactor/xml_data/00_base.php

include 'getData.php';

$xml = new XMLWriter();
$xml->openMemory();
$xml->setIndent(true);
$xml->setIndentString('    '); 

$xml->startDocument('1.0', 'UTF-8');

$xml->startElementNS('rsm', 'CrossIndustryInvoice', null);
$xml->writeAttribute('xmlns:qdt', 'urn:un:unece:uncefact:data:standard:QualifiedDataType:100');
$xml->writeAttribute('xmlns:ram', 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100');
$xml->writeAttribute('xmlns:xs', 'http://www.w3.org/2001/XMLSchema');
$xml->writeAttribute('xmlns:udt', 'urn:un:unece:uncefact:data:standard:UnqualifiedDataType:100');
$xml->writeAttribute('xmlns:rsm', 'urn:un:unece:uncefact:data:standard:CrossIndustryInvoice:100' );

include '01_ExchangedDocumentContext/index.php';
include '02_ExchangedDocument/index.php';

$xml->startElementNS('rsm', 'SupplyChainTradeTransaction', null);
include '03_SupplyChainTradeTransaction/index.php';
include '04_ApplicableHeaderTradeAgreemen/index.php';
include '05_ApplicableHeaderTradeSettlement/index.php';
$xml->endElement();

$xml->endElement(); 

$xml->endDocument();

$xmlContent = $xml->outputMemory(true);

//file_put_contents('invoice.xml', $xmlContent); //echo "XML файл успешно сгенерирован и сохранен как 'invoice.xml'.\n";

// header('Content-Type: application/xml');
// header('Content-Disposition: attachment; filename="invoice.xml"');
// header('Content-Length: ' . strlen($xmlContent));

// echo $xmlContent;

?>


