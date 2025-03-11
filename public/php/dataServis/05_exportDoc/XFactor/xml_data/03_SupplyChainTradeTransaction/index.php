<?php

$xml->startElementNS('rsm', 'SupplyChainTradeTransaction', null);

    $xml->startElementNS('ram', 'IncludedSupplyChainTradeLineItem', null);

    // Элемент <ram:AssociatedDocumentLineDocument>
    $xml->startElementNS('ram', 'AssociatedDocumentLineDocument', null);
        $xml->startElementNS('ram', 'LineID', null);
            $xml->text('1');
        $xml->endElement(); // Закрываем <ram:LineID>
    $xml->endElement(); // Закрываем <ram:AssociatedDocumentLineDocument>

    // Элемент <ram:SpecifiedTradeProduct>
    $xml->startElementNS('ram', 'SpecifiedTradeProduct', null);
        $xml->startElementNS('ram', 'Name', null);
            $xml->text('Honorarobjekt A');
        $xml->endElement(); // Закрываем <ram:Name>
    $xml->endElement(); // Закрываем <ram:SpecifiedTradeProduct>

    // Элемент <ram:IncludedNote>
    $xml->startElementNS('ram', 'IncludedNote', null);
        $xml->startElementNS('ram', 'Content', null);
            $xml->text("Honorargrundlagen\nHOAI Version 2021\nPlanungsgegenstand § 34 Gebäude\nHonorarzone III\nHonorarsatz Mittelsatz\nAnrechenbare Kosten 8.234.134,66 €\nHonorarnach Honorartafel 837.989,51 €\nZuschlag 0%");
        $xml->endElement(); // Закрываем <ram:Content>
    $xml->endElement(); // Закрываем <ram:IncludedNote>

    $xml->endElement(); // Закрываем <ram:IncludedSupplyChainTradeLineItem>


$xml->endElement(); // Закрываем <rsm:SupplyChainTradeTransaction>


?>