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





$xml->endElement(); // Закрываем основной элемент <rsm:Crosslndustrylnvoice>

// Завершаем документ
$xml->endDocument();

// Получаем сгенерированный XML
$xmlContent = $xml->outputMemory(true);

// Записываем XML в файл
//file_put_contents('invoice.xml', $xmlContent); //echo "XML файл успешно сгенерирован и сохранен как 'invoice.xml'.\n";

// Устанавливаем заголовки, чтобы заставить браузер показать диалог загрузки файла
header('Content-Type: application/xml');
header('Content-Disposition: attachment; filename="invoice.xml"');
header('Content-Length: ' . strlen($xmlContent));

// Отправляем содержимое XML
echo $xmlContent;


