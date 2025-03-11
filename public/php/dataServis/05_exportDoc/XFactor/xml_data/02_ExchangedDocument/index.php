<?php

// Начинаем элемент <rsm:ExchangedDocument>
$xml->startElementNS('rsm', 'ExchangedDocument', null);

    $xml->startElementNS('ram', 'ID', null); 
        $xml->text('RE 600'); 
    $xml->endElement(); 

    $xml->startElementNS('ram', 'TypeCode', null); 
        $xml->text('386'); 
    $xml->endElement(); 

    $xml->startElementNS('ram', 'IssueDateTime', null); 
        $xml->startElementNS('udt', 'DateTimeString', null);
            $xml->writeAttribute('format', '102');
            $xml->text('20250228');
        $xml->endElement();
    $xml->endElement();

    $xml->startElementNS('ram', 'IncludedNote', null); 
        $xml->startElementNS('ram', 'Content', null);
            $xml->text('Gem. § 14b Abs. 1 S.4 Umsatzsteuergesetz muss diese Rechnung und ein Zahlungsbeleg für zwei Jahre aufbewahrt werden. Die Aufbewahrungsfrist beginnt mit dem Ende des Kalenderjahres, in dem die Rechnung ausgestellt wurde. Ein Verstoß kann nach § 26a Abs. 2 UStG mit bis zu 500 EUR Geldbuße geahndet werden.');
        $xml->endElement();
    $xml->endElement();

$xml->endElement(); // Закрываем rsm:ExchangedDocument>


?>