<?php
$mysql_HOAI = $mysql;
$mysql = $mysql_calc;

$bill_id = $rq_data-> id;

$id = $_GET['bill'];
$downLoad_token = $_GET['download_token'];
$type = $_GET['type'];
$id = $mysql->real_escape_string($id);
$downLoad_token = $mysql->real_escape_string($downLoad_token);

if($downLoad_token!=''){
    
    $selector = "`id`='$id' AND `downLoad_token`='$downLoad_token'";

    $bill = crud_read('project_bills',"*", $selector);
    $bill = $bill[0];

    $bill['data'] = json_decode( fixJsonUTF8( $bill['data']) );
    $bill= $bill['data'];

    switch ($type) {
        case 'excel': include "excel/bill/excel.php"; break;
        case 'pdf': include "pdf/bill/pdf.php"; break;
        case 'pdf_': include "XFactor/xml_data/00_base.php"; break;
    }

    // include "XFactor/xml_data/00_base.php"; //$xmlContent

    // include_once $_SERVER['DOCUMENT_ROOT']."/php/dataServis/05_exportDoc/XFactor/vendor/autoload.php";

    // $writer = new \Atgp\FacturX\Writer();

    // try {
    //     $result = $writer->generate($pdfContent, $xmlContent, null, true, [], true, '');
    //     header('Content-disposition: attachment; filename="facturx.pdf"');
    //     header('Content-Type: application/pdf');
    //     header('Content-Length: '.strlen($result));
    //     echo $result;
    // }
    // catch (Exception $e) {
    //     echo'Error while generating the Factur-X :<pre>'.$e.'</pre>';
    // }

}


?>