<?php

$mysql = $mysql_;
$id_HOAI = $bill_object -> HOAI_version_id;
$id_HOAI = $mysql->real_escape_string($id_HOAI);
$selector = "`id` = '$id_HOAI'";
$data_hoai = crud_read('HOAI_versions',"*", $selector)[0];
$HOAI_Version = "HOAI Version ".$data_hoai['value'];

$paragraph_id = $bill_object -> paragraph_id;
$paragraph_id = $mysql->real_escape_string($paragraph_id);
$selector = "`id` = '$paragraph_id'";
$data_paragraph = crud_read('paragraphs',"*", $selector)[0];
$paragraph = "Planungsgegenstand ".$data_paragraph['name']." ".$data_paragraph['title'];

$selector = "`id_paragraph` = '$paragraph_id'";
$fee_type = crud_read('feeTableTypeValue',"*", $selector)[0];
$fee_type = $fee_type['value'];
if($fee_type=='Hektar'){$fee_type='Hek';}else{$fee_type='€';}

$honorarLevel = $bill_object -> honorarLevel -> value;
$honorarRate = "Honorarsatz ". $bill_object -> HonorarRate -> value;
if($bill_object -> HonorarRate -> value == 'Prozent eingeben') $honorarRate = $honorarRate. $bill_object -> HonorarRate -> percent ." %";

$anrechenbare_kosten = $bill_object -> finance -> value;
$anrechenbare_kosten = (float)$anrechenbare_kosten;
$anrechenbare_kosten = number_format($anrechenbare_kosten, 2, ',', '.');
$anrechenbare_kosten = "Anrechenbare Kosten $anrechenbare_kosten €";

$honorarnach_honorartafel = $bill_object -> honorar_total;
$honorarnach_honorartafel = (float)$honorarnach_honorartafel;
$honorarnach_honorartafel = number_format($honorarnach_honorartafel, 2, ',', '.');
$honorarnach_honorartafel = "Honorarnach Honorartafel $honorarnach_honorartafel $fee_type";

$zuschlag = $bill_object -> payExtra -> percent;
$zuschlag = "Zuschlag $zuschlag%";

$xml->startElementNS('ram', 'IncludedSupplyChainTradeLineItem', null);

// Элемент <ram:AssociatedDocumentLineDocument>
$xml->startElementNS('ram', 'AssociatedDocumentLineDocument', null);
    $xml->startElementNS('ram', 'LineID', null);
        $xml->text($num_obj);
    $xml->endElement(); // Закрываем <ram:LineID>
$xml->endElement(); // Закрываем <ram:AssociatedDocumentLineDocument>

// Элемент <ram:SpecifiedTradeProduct>
$xml->startElementNS('ram', 'SpecifiedTradeProduct', null);
    $xml->startElementNS('ram', 'Name', null);
        $xml->text( $bill_object -> name );
    $xml->endElement(); // Закрываем <ram:Name>
$xml->endElement(); // Закрываем <ram:SpecifiedTradeProduct>

// Элемент <ram:IncludedNote>
$xml->startElementNS('ram', 'IncludedNote', null);
    $xml->startElementNS('ram', 'Content', null);
        $xml->text("Honorargrundlagen\n$HOAI_Version\n$paragraph\n$honorarLevel\n$honorarRate\n$anrechenbare_kosten\n$honorarnach_honorartafel\n$zuschlag");
    $xml->endElement(); // Закрываем <ram:Content>
$xml->endElement(); // Закрываем <ram:IncludedNote>

$xml->endElement(); // Закрываем <ram:IncludedSupplyChainTradeLineItem>


?>