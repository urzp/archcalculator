<?php

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

$xml->endElement(); // Закрываем <rsm:ExchangedDocumentContext>

?>
