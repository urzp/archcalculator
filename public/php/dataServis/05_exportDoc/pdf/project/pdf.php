<?php

function toMoney($value){
    $result = '';
    $result = number_format($value, 2).' €';
    $result = str_replace(',', ' ', $result);
    $result = str_replace('.', ',', $result);
    return $result;
}

function toFormat($value, $sumbol=""){
    $result = '';
    $result = number_format($value, 2).$sumbol;
    $result = str_replace(',', ' ', $result);
    $result = str_replace('.', ',', $result);
    return $result;
}

$project = $data['project'];
$objects = $data['objects'];

$project_name = $project['name'];
$project_data = date('d.m.Y',strtotime($project['created']));
$project_description = $project['discription'];

$project_summe_net = toMoney($project['total_net']);
$project_tax = toFormat($project['tax'], '%');
$project_summe_tax = toMoney($project['total_tax']);
$project_summe = toMoney($project['total']);

require_once ($_SERVER['DOCUMENT_ROOT'].'/php/lib/dompdf/autoload.inc.php');
use Dompdf\Dompdf;
$dompdf = new DOMPDF();

include 'blocks_pdf.php';

//$css_1 = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/php/dataServis/05_exportDoc/fonts/fonts.css');

$root = $_SERVER['DOCUMENT_ROOT'];

include $root.'/php/dataServis/05_exportDoc/pdf/fonts/Rawline/css_font_Rawline.php';
include $root.'/php/dataServis/05_exportDoc/pdf/fonts/Comfortaa/css_font_Comfortaa.php';
include $root.'/php/dataServis/05_exportDoc/pdf/fonts/DroidSans/css_font_DroidSans.php';

$css = file_get_contents($root.'/php/dataServis/05_exportDoc/pdf/project/styles.css');

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
            <div class='title_0 project_name center-align'>$project_name</div>
            <div class='title_5 project_data center-align'>$project_data</div>
            <div class='title_1 project_description'>$project_description</div>
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
                        <td class='title_3 number' style='width: 25%; text-align: left;'>$project_tax</td>
                        <td class='title_3 number' style='width: 25%; text-align: right;'>$project_summe_tax</td>
                    </tr>
                    <tr>
                        <td class='title_3' style='width: 50%; padding-left: 20px; text-align: left;'>Gesamtsumme Brutto</td>
                        <td class='title_3' style='width: 25%; text-align: left;'></td>
                        <td class='title_3 number' style='width: 25%; text-align: right;'>$project_summe</td>
                    </tr>
                </table>
                <div class='total_project'>
                    <div class='title_1'>$project_name</div>
                    <div class='title_1 number-bold total_project_Summe'>Summe: $project_summe </div>
                </div>
            </div>
        </div>
";
        
$html .="
    </body>
</html>
";

$dompdf->load_html($html);
$dompdf->set_option('isRemoteEnabled', TRUE);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("{$project_name}.pdf");

?>