<?php
$xml->startElementNS('ram', 'ApplicableHeaderTradeDelivery', null);
$xml->endElement();

$xml->startElementNS('ram', 'ApplicableHeaderTradeSettlement', null);

    $xml->startElementNS('ram', 'PaymentReference', null);
        $xml->text($bill->invoice_number);
    $xml->endElement(); 

    $xml->startElementNS('ram', 'InvoiceCurrencyCode', null);
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
            $xml->startElementNS('ram', 'ProprietaryID', null);
                $xml->text('Client 265'); 
            $xml->endElement();
        $xml->endElement(); 
    $xml->endElement(); 

    // $xml->startElementNS('ram', 'BillingSpecifiedPeriod', null);
    //     $xml->startElementNS('ram', 'StartDateTime', null);
    //         $xml->startElementNS('udt', 'DateTimeString', null);
    //             $xml->writeAttribute('format', '102');
    //             $xml->text((new DateTime($bill -> payment_date -> vom ))->format('Ymd')  );
    //         $xml->endElement();
    //     $xml->endElement();
    //     $xml->startElementNS('ram', 'EndDateTime', null);
    //         $xml->startElementNS('udt', 'DateTimeString', null);
    //             $xml->writeAttribute('format', '102');
    //             $xml->text((new DateTime($bill -> payment_date -> bis ))->format('Ymd')  );
    //         $xml->endElement();
    //     $xml->endElement();
    // $xml->endElement();

foreach($bill -> previos_payments as $item){

    if($item -> paid_value == '0'){
        $ChargeIndicator = 'false';
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

    $tax = (float)($bill -> tax);
    $CalculatedAmount = $bill -> payment_total * ($tax/100);
    $CalculatedAmount = number_format($CalculatedAmount, 2, '.', '' );
    $tax = number_format($tax, 1, '.', '' );
    $BasisAmount = number_format($bill -> payment_total, 2, '.', '' );

    $xml->startElementNS('ram', 'ApplicableTradeTax', null);
        $xml->startElementNS('ram', 'CalculatedAmount', null);
            $xml->text( $CalculatedAmount );
        $xml->endElement();
        $xml->startElementNS('ram', 'TypeCode', null);
            $xml->text( 'VAT' );
        $xml->endElement();
        $xml->startElementNS('ram', 'BasisAmount', null);
            $xml->text( $BasisAmount );
        $xml->endElement();
        $xml->startElementNS('ram', 'CategoryCode', null);
            $xml->text( 'S' );
        $xml->endElement();
        $xml->startElementNS('ram', 'RateApplicablePercent', null);
            $xml->text( $tax );
        $xml->endElement();
    $xml->endElement();

    $payment_date = (new DateTime($bill -> payment_date -> bis ))->format('d.m.Y') ;

    $xml->startElementNS('ram', 'SpecifiedTradePaymentTerms', null);
        $xml->startElementNS('ram', 'Description', null);
            $xml->text( "Bitte zahlen Sie den Betrag bis zum $payment_date an die unten genannte Bankverbindung." );
        $xml->endElement();
        $xml->startElementNS('ram', 'DueDateDateTime', null);   
            $xml->startElementNS('udt', 'DateTimeString', null);   
                $xml->writeAttribute('format', '102');
                $xml->text( (new DateTime($bill -> payment_date -> bis ))->format('Ymd') );
            $xml->endElement();
        $xml->endElement();
    $xml->endElement();


    $LineTotalAmount =$bill->total_net;
    $LineTotalAmount = number_format($LineTotalAmount, 2, '.', '' );

    $TaxBasisTotalAmount = $LineTotalAmount;

    $TaxTotalAmount = $bill->total_tax;
    $TaxTotalAmount = number_format($TaxTotalAmount, 2, '.', '' );

    $GrandTotalAmount = $bill-> total;
    $GrandTotalAmount = number_format($GrandTotalAmount, 2, '.', '' );

    $TotalPrepaidAmount = $bill-> previos_payments_total;
    $TotalPrepaidAmount = number_format($TotalPrepaidAmount, 2, '.', '' );

    $DuePayableAmount = $bill-> payment_total;
    $DuePayableAmount = number_format($DuePayableAmount, 2, '.', '' );

    $xml->startElementNS('ram', 'SpecifiedTradeSettlementHeaderMonetarySummation', null);
        $xml->startElementNS('ram', 'LineTotalAmount', null);
            $xml->text( $LineTotalAmount  );
        $xml->endElement();
        $xml->startElementNS('ram', 'ChargeTotalAmount', null); //not used
            $xml->text( '0' );
        $xml->endElement();
        $xml->startElementNS('ram', 'AllowanceTotalAmount', null); //not used
            $xml->text( '0' );
        $xml->endElement();
        $xml->startElementNS('ram', 'TaxBasisTotalAmount', null);
            $xml->text( $TaxBasisTotalAmount  );
        $xml->endElement();
        $xml->startElementNS('ram', 'TaxTotalAmount', null);
            $xml->writeAttribute('currencyID', 'EUR');
            $xml->text( $TaxTotalAmount  );
        $xml->endElement();
        $xml->startElementNS('ram', 'GrandTotalAmount', null);
            $xml->text( $GrandTotalAmount  );
        $xml->endElement();
        $xml->startElementNS('ram', 'TotalPrepaidAmount', null);
            $xml->text( $TotalPrepaidAmount  );
        $xml->endElement();
        $xml->startElementNS('ram', 'DuePayableAmount', null);
            $xml->text( $DuePayableAmount  );
        $xml->endElement();
    $xml->endElement();

$xml->endElement(); 

?>