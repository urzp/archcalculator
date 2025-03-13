<?php

$xml->startElementNS('ram', 'ApplicableHeaderTradeSettlement', null);

    $xml->startElementNS('ram', 'ApplicableHeaderTradeSettlement', null);
        $xml->text('EUR'); 
    $xml->endElement(); 

    $xml->startElementNS('ram', 'SpecifiedTradeSettlementPaymentMeans', null);
        $xml->startElementNS('ram', 'TypeCode', null);
            $xml->text('58'); 
        $xml->endElement(); 
        $xml->startElementNS('ram', 'PayeePartyCreditorFinancialAccount', null);
            $xml->startElementNS('ram', 'IBANID', null);
                $xml->text($bill->user_IBAN ); 
            $xml->endElement(); 
            $xml->startElementNS('ram', 'AccountName', null);
                $xml->text($bill->user_name); 
            $xml->endElement(); 
            $xml->startElementNS('ram', 'FinancialInstitutionBranchID', null);
                $xml->text($bill->user_BIC); 
            $xml->endElement();
        $xml->endElement(); 
        $xml->startElementNS('ram', 'PaymentReference', null);
            $xml->text($bill->invoice_number);
        $xml->endElement(); 
    $xml->endElement(); 



$xml->endElement(); 

?>