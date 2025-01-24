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


$css = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/php/dataServis/05_exportDoc/pdf/styles.css');

$html = "
<html>
    <head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
    <style type='text/css'>";
    $html .= $css;
    $html .="</style>
    </head>";
    
$html .="<body>
            <div class='project_name'>$project_name</div>
            <div class='project_data'>$project_data</div>
            <div class='project_description'>$project_description</div>
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