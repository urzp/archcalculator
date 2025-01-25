<?php

$project = $data['project'];
$objects = $data['objects'];

$project_name = $project['name'];
$project_data = date('d.m.Y',strtotime($project['created']));
$project_description = $project['discription'];

require_once ($_SERVER['DOCUMENT_ROOT'].'/php/lib/dompdf/autoload.inc.php');
use Dompdf\Dompdf;
$dompdf = new DOMPDF();

// include 'blocks_pdf.php';

//$css_1 = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/php/dataServis/05_exportDoc/fonts/fonts.css');

$root = $_SERVER['DOCUMENT_ROOT'];

include $root.'/php/dataServis/05_exportDoc/pdf/fonts/Rawline/css_font_Rawline.php';
include $root.'/php/dataServis/05_exportDoc/pdf/fonts/Comfortaa/css_font_Comfortaa.php';

$css = file_get_contents($root.'/php/dataServis/05_exportDoc/pdf/project/styles.css');

$html = "
<html>
    <head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
    <style type='text/css'>";
    $html .= $css_font_Rawline;
    $html .= $css_font_Comfortaa;
    $html .= $css;
    $html .="</style>
    </head>";
    
$html .="<body>
            <div class='title_0 project_name center-align'>$project_name</div>
            <div class='title_5 project_data center-align'>$project_data</div>
            <div class='title_1 project_description'>$project_description</div>
";

$html .="   
        <div class='title_1 summe_title'>
            <img src='' alt='' class='r-marker'>Summe: $project_name
        </div>
        <div class='summ_wrap'>
            <div class='title_2'>Zusätzliche Leistungen</div>
            <div class='title_2'>Nebenkosten</div>
            <div class='title_2'>Zusammenfassung</div>
            <div class='Zusammenfassung'>
                <div class='title_3'>Gesamtsumme Netto</div>
                <div class='title_3'>Umsatzsteuer</div>
                <div class='title_3'>Gesamtsumme Brutto</div>
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