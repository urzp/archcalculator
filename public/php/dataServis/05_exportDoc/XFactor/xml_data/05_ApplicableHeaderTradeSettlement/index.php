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

    $xml->startElementNS('ram', 'BillingSpecifiedPeriod', null);
        $xml->startElementNS('ram', 'StartDateTime', null);
            $xml->startElementNS('udt', 'DateTimeString', null);
                $xml->writeAttribute('format', '102');
                $xml->text((new DateTime($bill -> payment_date -> vom ))->format('Ymd')  );
            $xml->endElement();
        $xml->endElement();
        $xml->startElementNS('ram', 'EndDateTime', null);
            $xml->startElementNS('udt', 'DateTimeString', null);
                $xml->writeAttribute('format', '102');
                $xml->text((new DateTime($bill -> payment_date -> bis ))->format('Ymd')  );
            $xml->endElement();
        $xml->endElement();
    $xml->endElement();

foreach($bill -> previos_payments as $item){

    if($item -> paid_value == '0'){
        $ChargeIndicator = 'true';
        $Reason = 'Zahlung vom -';
        $ActualAmount = '0';
    }else{
        $ChargeIndicator = 'false';
        $date = (new DateTime( $item -> paid_date ))->format('d.m.Y');
        $Reason = 'Zahlung vom '.$date;
        $ActualAmount = $item->paid_value;
    }

    $xml->startElementNS('ram', 'SpecifiedTradeAllowanceCharge', null);
        $xml->startElementNS('ram', 'ChargeIndicator', null);
            $xml->text( $ChargeIndicator );
        $xml->endElement();
        $xml->startElementNS('ram', 'Reason', null);
            $xml->text( $Reason );
        $xml->endElement();
        $xml->startElementNS('ram', 'ActualAmount', null);
            $xml->text( $ActualAmount );
        $xml->endElement();
    $xml->endElement();

}

    $xml->startElementNS('ram', 'ApplicableTradeTax', null);
        $xml->startElementNS('ram', 'CalculatedAmount', null);
            $xml->text( $ActualAmount );
        $xml->endElement();
        $xml->startElementNS('ram', 'TypeCode', null);
            $xml->text( 'VAT' );
        $xml->endElement();
        $xml->startElementNS('ram', 'BasisAmount', null);
            $xml->text( '132734.19' );
        $xml->endElement();
        $xml->startElementNS('ram', 'CategoryCode', null);
            $xml->text( 'S' );
        $xml->endElement();
        $xml->startElementNS('ram', 'RateApplicablePercent', null);
            $xml->text( '19' );
        $xml->endElement();
    $xml->endElement();

    $xml->startElementNS('ram', 'SpecifiedTradePaymentTerms', null);
        $xml->startElementNS('ram', 'Description', null);
            $xml->text( 'Bitte zahlen Sie den Betrag bis zum 5.3.2025 an die unten genannte Bankverbindung.' );
        $xml->endElement();
        $xml->startElementNS('ram', 'DueDateDateTime', null);   
            $xml->startElementNS('udt', 'DateTimeString', null);   
                $xml->writeAttribute('format', '102');
                $xml->text( '20250305' );
            $xml->endElement();
        $xml->endElement();
    $xml->endElement();


$xml->endElement(); 

?>