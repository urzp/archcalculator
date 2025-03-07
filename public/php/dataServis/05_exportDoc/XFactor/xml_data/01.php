<?php

// Создаем новый объект XMLWriter
$xml = new XMLWriter();
$xml->openMemory();
$xml->setIndent(true);
$xml->setIndentString('    '); // Указываем отступ для читаемости

// Начинаем запись XML документа
$xml->startDocument('1.0', 'UTF-8');

// Начинаем основной элемент <rsm:Crosslndustrylnvoice>
$xml->startElementNS('rsm', 'CrossIndustryInvoice', 'urn:un:unece:uncefact:data:standard:CrossIndustryInvoice:100');
$xml->writeAttribute('xmlns:qdt', 'urn:un:unece:uncefact:data:standard:QualifiedDataType:100');
$xml->writeAttribute('xmlns:ram', 'urn:un:unece:uncefact:data:standard:ReusableAggregateBusinessInformationEntity:100');
$xml->writeAttribute('xmlns:xs', 'http://www.w3.org/2001/XMLSchema');
$xml->writeAttribute('xmlns:udt', 'urn:un:unece:uncefact:data:standard:UnqualifiedDataType:100');

// Начинаем элемент <rsm:ExchangedDocumentContext>
$xml->startElementNS('rsm', 'ExchangedDocumentContext', null);

// Начинаем элемент <ram:BusinessProcessSpecifiedDocumentContextParameter>
$xml->startElementNS('ram', 'BusinessProcessSpecifiedDocumentContextParameter', null);
$xml->startElementNS('ram', 'ID', null);
$xml->text('urn:fdc:peppol.eu:2017:poacc:billing:01:1.0'); // Добавляем текст
$xml->endElement(); // Закрываем <ram:ID>
$xml->endElement(); // Закрываем <ram:BusinessProcessSpecifiedDocumentContextParameter>

// Начинаем элемент <ram:GuidelineSpecifiedDocumentContextParameter>
$xml->startElementNS('ram', 'GuidelineSpecifiedDocumentContextParameter', null);
$xml->startElementNS('ram', 'ID', null);
$xml->text('urn:cen.eu:en16931:2017#compliant#urn:xeinkauf.de:kosit:xrechnung_3.0'); // Добавляем текст
$xml->endElement(); // Закрываем <ram:ID>
$xml->endElement(); // Закрываем <ram:GuidelineSpecifiedDocumentContextParameter>

// Закрываем элемент <rsm:ExchangedDocumentContext>
$xml->endElement(); // Закрываем <rsm:ExchangedDocumentContext>

// Закрываем основной элемент <rsm:Crosslndustrylnvoice>
$xml->endElement(); // Закрываем <rsm:Crosslndustrylnvoice>

// Завершаем документ
$xml->endDocument();

// Получаем сгенерированный XML
$xmlContent = $xml->outputMemory(true);

// Устанавливаем заголовки, чтобы заставить браузер показать диалог загрузки файла
header('Content-Type: application/xml');
header('Content-Disposition: attachment; filename="invoice.xml"');
header('Content-Length: ' . strlen($xmlContent));

// Отправляем содержимое XML
echo $xmlContent;

exit;