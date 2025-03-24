<?php

$billData = $bill['data'];

require_once ($_SERVER['DOCUMENT_ROOT'].'/php/lib/dompdf/autoload.inc.php');
use Dompdf\Dompdf;
$dompdf = new DOMPDF();

include 'blocks_pdf.php';

$imagePath = '';	
if(isset($billData -> user_logo)&&!empty($billData -> user_logo)){
	$imagePath = $billData -> user_logo;
}

$vom = date('d.m.Y',strtotime($billData -> payment_date -> vom));
$bis = date('d.m.Y',strtotime($billData -> payment_date -> bis));
$created = date('d.m.Y',strtotime($billData -> created));
$total_rest = toMoney($billData->total_rest);
$val_1 = $billData -> total_rest;
$val_2 = $val_1 * ($billData->tax/100);
$pay_date = $billData -> payment_date -> bis;
$pay_date = date('d.M.Y',strtotime($pay_date)) ;
$css = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/php/dataServis/05_exportDoc/pdf/styles.css');

$html = "
<html>
    <head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
    <style type='text/css'>";
    $html .= $css;
    $html .="</style>
    </head>
    <body>

    <div class='user_name'> {$billData -> user_data}</div> <div class='logo'> <img src='$imagePath' alt='$imagePath'> </div>
    <div class='bold'>{$billData -> custemer -> company}</div>
    <div class='bold'>{$billData -> custemer -> name}</div>
    <div class='bold'>{$billData -> custemer -> address_1}</div>
    <div class='bold'>{$billData -> custemer -> address_2}</div>
    <div class='row_gap'></div>
    <div class='row_gap'></div>
    <div class='bold project_name'>{$billData -> project -> name}</div>
    <div>{$billData -> project -> discription}</div>
    <div class='pay_data'> Leistungszeitraum vom $vom bis $bis </div>
    <div class='content_left_right'>
        <div class='bold left'>Rechnung Nr.</div>
        <div class='bold right'>{$billData -> invoice_number}</div>
    </div>
    <div class='content_left_right'>
        <div class='bold left'>Datum</div>
        <div class='bold right'>{$created}</div>
    </div>
    <div class='row_gap'></div>
    <div class='number_bill'>{$billData -> number_bill}</div>
    <div class='greeting_phrase_content'>{$billData -> greeting_phrase}</div>
    <div class='item_title bold'>I. Grundleistungen</div>";
$html .= render_objects($billData -> objects);
$html .= "
    <div class='item_title bold'>II. Zusätzliche Leistungen</div>
";
$html .= render_extra_servis($billData);
$html .= "
    <div class='item_title bold'>III. Nebenkosten</div>
";
$html .= render_extraCosts($billData);
$html .= "
    <div class='item_title bold'>VI. Zwischensumme</div>
";
$html .= render_totalProject($billData);
$html .= "
    <div class='item_title bold'>V. Gesamt- und Resthonoraranspruch</div>
";
$html .= render_payments($billData);
$html .= "
    <div class='item_title content_left_right'>
        <div class='bold left'>Rechnungsbetrag</div>
        <div class='bold right'>{$total_rest}</div>
    </div>
";

$html .= "
    <div class='row_gap'></div>
    <div>Im Betrag von $val_1 € sind  $val_2 € Mehrwertsteuer enthalten.</div>
    <div>Bitte zahlen Sie den Betrag bis zum $pay_date an die unten genannte Bankverbindung.</div>
    <div class='row_gap'></div>
";

$html .="
    <table class='total_project' style='width: 690px;'>
        <tr>
            <td style='width: 40%; text-align: left;'>Kontoinhaber</td>
            <td style='width: 40%; text-align: left;'>{$billData -> user_name}</td>
        </tr>
        <tr>
            <td style='width: 40%; text-align: left;'>IBAN:</td>
            <td style='width: 40%; text-align: left;'>{$billData -> user_IBAN}</td>
        </tr>
        <tr>
            <td style='width: 40%; text-align: left;'>BIC:</td>
            <td style='width: 40%; text-align: left;'>{$billData -> user_BIC}</td>
        </tr>
        <tr>
            <td style='width: 40%; text-align: left;'>Institut</td>
            <td style='width: 40%; text-align: left;'>{$billData -> user_Institut}</td>
        </tr>
        <tr>
            <td style='width: 40%; text-align: left;'>USt-ld.-Nr.</td>
            <td style='width: 40%; text-align: left;'>{$billData -> user_USt}</td>
        </tr>
    </table>
    <div class='row_gap'></div>
    <div>Gem. § 14b Abs. 1 S.4 Umsatzsteuergesetz muss diese Rechnung und ein Zahlungsbeleg für zwei Jahre aufbewahrt werden. Die Aufbewahrungsfrist beginnt mit dem Ende des Kalenderjahres, in dem die Rechnung ausgestellt wurde.  Ein Verstoß kann nach § 26a Abs. 2 UStG mit bis zu 500 EUR Geldbuße geahndet werden.</div>
";


$html .="
    </body>
</html>
";

$dompdf->load_html($html);
$dompdf->set_option('isRemoteEnabled', TRUE);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("{$billData -> project -> name}.pdf");

?>