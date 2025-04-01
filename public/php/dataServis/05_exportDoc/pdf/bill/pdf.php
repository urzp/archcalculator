<?php

$project = $bill->project;
$objects = $bill->objects;

$imagePath = '';	
if(isset($project -> user_logo)&&!empty($project -> user_logo)){
	$imagePath = $project -> user_logo;
    //$imagePath = 'https://static.tildacdn.com/tild3137-3636-4931-b732-313966393164/Group_89_1.svg';
    $imagePath = 'https://honorar.online/users/user_2/avatar/1733807917_unnamed.jpg';
    //$imagePath = str_replace('https://honorar.online', '', $imagePath);
    //$imagePath = $_SERVER['DOCUMENT_ROOT'].$imagePath;
}

$project_name = $project->name;
$project_data = date('d.m.Y',strtotime($project->created));
$payment_date_vom = date('d.m.Y',strtotime($project->payment_date->vom));
$payment_date_bis = date('d.m.Y',strtotime($project->payment_date->bis));
$project_description = $project->discription;

$customer = $project -> customer;

$project_summe_net = toMoney($project->total_net);
$project_tax = toFormat($project->tax, '%');
$project_summe_tax = toMoney($project->total_tax);
$project_summe = toMoney($project->total);

$invoice_number = $project->invoice_number;
$greeting_phrase = $project->greeting_phrase;

$previos_payments_total = toMoney($project->previos_payments_total);
$rest_payment_total = toMoney($project->payment_total);

require_once ($_SERVER['DOCUMENT_ROOT'].'/php/lib/dompdf/autoload.inc.php');
use Dompdf\Dompdf;
$dompdf = new DOMPDF();

include 'blocks_pdf.php';

//$css_1 = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/php/dataServis/05_exportDoc/fonts/fonts.css');

$root = $_SERVER['DOCUMENT_ROOT'];

include $root.'/php/dataServis/05_exportDoc/pdf/fonts/Rawline/css_font_Rawline.php';
include $root.'/php/dataServis/05_exportDoc/pdf/fonts/Comfortaa/css_font_Comfortaa.php';
include $root.'/php/dataServis/05_exportDoc/pdf/fonts/DroidSans/css_font_DroidSans.php';

$css = file_get_contents($root.'/php/dataServis/05_exportDoc/pdf/bill/styles.css');

$html = "
<html>
    <head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
    <style type='text/css'>";
    $html .= $css_font_Rawline;
    $html .= $css_font_Comfortaa;
    $html .= $css_font_DroidSans;
    $html .= $css;
    $html .="</style>
    </head>";
    
$html .="<body>
            <div class='title_2 project_user_name'>$project->user_data</div><div class='logo'> <img src='$imagePath' alt=''> </div>

            <div class='title_2 project_customer bold'>$customer->company</div>
            <div class='title_2 project_customer bold'>$customer->name</div>
            <div class='title_2 project_customer bold'>$customer->address_1</div>
            <div class='title_2 project_customer bold'>$customer->address_2</div>

            <div class='title_2 project_name bold'>$project_name</div>
            <div class='title_2 project_description'>$project_description</div>

            <table>
                <tr>
                    <td class='title_2 bold' style='width: 350px;  text-align: left;'>Rechnung Nr.</td>
                    <td class='title_2 bold' style='width: 345px;  text-align: right;'>$invoice_number</td>
                </tr>
                <tr>
                    <td class='title_2 bold' style='width: 350px;  text-align: left;'>Datum</td>
                    <td class='title_2 bold' style='width: 345px;  text-align: right;'>$project_data</td>
                </tr>
            </table>

            <div class='title_2' style='margin-top: -20px; margin-bottom: 20px;'>Leistungszeitraum vom $payment_date_vom bis $payment_date_bis</div>

            <div class='title_2 number_bill'>$project->number_bill</div>
            <div class='title_2 greeting_phrase'>$greeting_phrase</div>

            ";

$html .= $objects_html;

$html .="   
        <div class='title_1 summe_title'> Summe: $project_name</div>
        <div class='summ_wrap'>
            <div class='title_2'>Zusätzliche Leistungen</div>";

$html .= $project_AdditionalServices_html;                   

$html.="   
            <div class='title_2'>Nebenkosten</div>";

$html .= $project_ExtraCosts_html;

$html.="   <div class='title_2'>Zusammenfassung</div>                         
           <div class='Zusammenfassung'>
                <table class='row_style' style='width: 680px;'>
                    <tr>
                        <td class='title_3' style='width: 50%; padding-left: 20px; text-align: left;'>Gesamtsumme Netto</td>
                        <td class='title_3' style='width: 25%; text-align: left;'></td>
                        <td class='title_3 number' style='width: 25%; text-align: right; '>$project_summe_net</td>
                    </tr>
                    <tr>
                        <td class='title_3' style='width: 50%; padding-left: 20px; text-align: left;'>Umsatzsteuer</td>
                        <td class='title_3 number' style='width: 25%; text-align: right;'>$project_tax</td>
                        <td class='title_3 number' style='width: 25%; text-align: right;'>$project_summe_tax</td>
                    </tr>
                    <tr>
                        <td class='title_3' style='width: 50%; padding-left: 20px; text-align: left;'>Gesamtsumme Brutto</td>
                        <td class='title_3' style='width: 25%; text-align: left;'></td>
                        <td class='title_3 number' style='width: 25%; text-align: right;'>$project_summe</td>
                    </tr>
                </table>
                <div class='title_3 number' style='width: 640px; text-align: right;'>Summe Zusammenfassung:  $project_summe</div>

                <div class='title_2'>Gesamt- und Resthonoraranspruch</div>

                <table class='row_style' style='width: 680px;'> 
                    <tr>
                        <td class='title_3' style='width: 50%; padding-left: 20px; text-align: left;'>Rechnerisches Gesamthonorar</td>
                        <td class='title_3' style='width: 25%; text-align: left;'></td>
                        <td class='title_3 number' style='width: 25%; text-align: right; '>$project_summe</td>
                    </tr>
                    <tr>
                        <td class='title_3' style='width: 75%; padding-left: 20px; text-align: left;'>Abzüge für geleistete Abschlagszahlungen</td>
                        <td class='title_3' style='width: 0%; text-align: left;'></td>
                        <td class='title_3 number' style='width: 25%; text-align: right; '>-$previos_payments_total</td>
                    </tr>
                </table>";

$html.=          "<table style='width: 680px; line-height: 0.8; margin-top:-20px;'>";
foreach($project->previos_payments as $item){
    $paid_date = date('d.m.Y',strtotime($item->paid_date));
    $paid_value = toMoney($item->paid_value);
    $html.="
                
                    <tr>
                        <td class='title_4' style='width: 20%; padding-left: 20px; text-align: left;'>$item->invoice_number</td>
                        <td class='title_4' style='width: 20%; text-align: center;'>Zalung vom</td>
                        <td class='title_4' style='width: 20%; text-align: center;'>$paid_date</td>
                        <td class='title_4 number' style='width: 20%; text-align: center; '>$paid_value</td>
                        <td class='title_4 number' style='width: 20%; text-align: right; '></td>
                    </tr>     
    ";
};
$html.=             "</table>";

$html.= "       
                <table class='row_style' style='width: 680px;'>     
                <tr>
                    <td class='title_3' style='width: 50%; padding-left: 20px; text-align: left;'>Restlicher Honoraranspruch</td>
                    <td class='title_3' style='width: 25%; text-align: left;'></td>
                    <td class='title_3 number' style='width: 25%; text-align: right; '>$rest_payment_total</td>
                </tr>
                </table>

                <div class='total_project'>
                    <div class='title_1'>$project_name</div>
                    <div class='title_1 number-bold total_project_Summe'>Summe: $rest_payment_total </div>
                </div>
            </div>
            
        </div>
";

$tax_rest_total = toMoney($project->payment_total * ((float)$project->tax)/100);

$html.= "<div class='title_2 project_description'>Im Betrag von $rest_payment_total sind $tax_rest_total Mehrwertsteuer enthalten. Bitte zahlen Sie den Betrag bis zum $payment_date_bis an die unten genannte Bankverbindung.</div>";

$html.="
        <table style='width: 680px; line-height: 0.8; margin-top:10px;'>
            <tr>
                <td class='title_3' style='width: 25%; padding-left: 20px; text-align: left;'>Kontoinhaber</td>
                <td class='title_3' style='width: 25%; text-align: left;'></td>
            </tr>
            <tr>
                <td class='title_3' style='width: 25%; padding-left: 20px; text-align: left;'>IBAN:</td>
                <td class='title_3' style='width: 25%; text-align: left;'>$project->user_IBAN</td>
            </tr>
            <tr>
                <td class='title_3' style='width: 25%; padding-left: 20px; text-align: left;'>BIC:</td>
                <td class='title_3' style='width: 25%; text-align: left;'>$project->user_BIC</td>
            </tr>
            <tr>
                <td class='title_3' style='width: 25%; padding-left: 20px; text-align: left;'>Institut:</td>
                <td class='title_3' style='width: 25%; text-align: left;'>$project->user_Institut</td>
            </tr>
            <tr>
                <td class='title_3' style='width: 25%; padding-left: 20px; text-align: left;'>USt-Id.-Nr.</td>
                <td class='title_3' style='width: 25%; text-align: left;'>$project->user_USt</td>
            </tr>
        </table>
";

$html .="<div class='title_2 project_description'>Gem. § 14b Abs. 1 S.4 Umsatzsteuergesetz muss diese Rechnung und ein Zahlungsbeleg für zwei Jahre aufbewahrt werden. Die Aufbewahrungsfrist beginnt mit dem Ende des Kalenderjahres, in dem die Rechnung ausgestellt wurde. Ein Verstoß kann nach § 26a Abs. 2 UStG mit bis zu 500 EUR Geldbuße geahndet werden.</div>";
        
$html .="
    </body>
</html>
";

$dompdf->load_html($html);
$dompdf->set_option('isRemoteEnabled', TRUE);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
//$dompdf->stream("{$project_name}.pdf");
$pdfContent = $dompdf->output();

?>