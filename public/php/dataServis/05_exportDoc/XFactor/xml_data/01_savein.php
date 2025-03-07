<?php
// https://honorar.online/php/dataServis/05_exportDoc/XFactor/xml_data/01.php
// Создаем новый объект XMLWriter
$xml = new XMLWriter();
$xml->openMemory();
$xml->setIndent(true);
$xml->setIndentString('    '); // Указываем отступ для читаемости

// Начинаем запись XML документа
$xml->startDocument('1.0', 'UTF-8');

// Начинаем основной элемент <rsm:Crosslndustrylnvoice>
$xml->startElementNS('rsm', 'Crosslndustrylnvoice', null);

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

// Записываем XML в файл
file_put_contents('invoice.xml', $xmlContent);

//echo "XML файл успешно сгенерирован и сохранен как 'invoice.xml'.\n";