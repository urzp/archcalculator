<?php

//  https://honorar.online/php/dataServis/05_exportDoc/excel/excel.php

include "blocks_excel.php";

require_once($_SERVER['DOCUMENT_ROOT'].'/php/lib/PHPExcel-1.8/Classes/PHPExcel.php');
require_once($_SERVER['DOCUMENT_ROOT']."/php/lib/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel5.php");

$billData = $bill['data'];

$theXls = new PHPExcel();
$theXls->setActiveSheetIndex(0);
$_Sheet = $theXls->getActiveSheet();
$_Sheet->getSheetView()->setZoomScale(175);
$_Sheet->setTitle("Abschlag");

$_Sheet->getDefaultStyle()->getFont()->setSize(10); 

$_Sheet->getColumnDimension('A')->setWidth(1);
$_Sheet->getColumnDimension('B')->setWidth(1);
$_Sheet->getColumnDimension('C')->setWidth(1);
$_Sheet->getColumnDimension('D')->setWidth(1);
$_Sheet->getColumnDimension('E')->setWidth(2);
$_Sheet->getColumnDimension('F')->setWidth(2);
$_Sheet->getColumnDimension('G')->setWidth(35);
$_Sheet->getColumnDimension('H')->setWidth(10); 
$_Sheet->getColumnDimension('I')->setWidth(10); 
$_Sheet->getColumnDimension('J')->setWidth(10); 
$_Sheet->getColumnDimension('K')->setWidth(13); 
$_Sheet->getColumnDimension('L')->setWidth(15); 

//-----------------------------------------------------------------------------

//Architekt name
$_Sheet->setCellValue("A1", $billData -> user_data );
$_Sheet->getRowDimension(1)->setRowHeight(30);
$_Sheet->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$_Sheet->getStyle('A1')->getFont()->setSize(8); 

//Logo
$imagePath = '';	
if(isset($billData -> user_logo)&&!empty($billData -> user_logo)){
	$imagePath = $billData -> user_logo;
	$imagePath = explode("https://honorar.online", $imagePath)[1];
	$imagePath = $_SERVER['DOCUMENT_ROOT'].$imagePath; 
}
	
if (file_exists($imagePath)) {
	$logo = new PHPExcel_Worksheet_Drawing();
	$logo->setPath($imagePath);
    $logo->setHeight(40);
	$logo->setCoordinates("L1");				
	$logo->setOffsetX(50);
	$logo->setOffsetY(0);	
	$logo->setWorksheet($_Sheet);
} 

// Custemer

$_Sheet->setCellValue("A2", $billData -> custemer -> company);
$_Sheet->setCellValue("A3", $billData -> custemer -> name);
$_Sheet->setCellValue("A4",  $billData -> custemer -> address_1);
$_Sheet->setCellValue("A4",  $billData -> custemer -> address_2);
for($i = 2; $i <= 5; $i++){ $_Sheet->getRowDimension($i)->setRowHeight(12); }
$_Sheet->getStyle('A2:A5')->getFont()->setBold(true);

// Header
// Header: left

$_Sheet->setCellValue("A10", $billData -> project -> name);
$_Sheet->setCellValue("A11", $billData -> project -> discription);
$_Sheet->setCellValue("A12", "Rechnung Nr.");
$_Sheet->setCellValue("A13", "Datum");

$_Sheet->mergeCells("A11:L11");
$_Sheet->getRowDimension(11)->setRowHeight(40);
$_Sheet->getStyle('A11')->getAlignment()->setWrapText(true);
$_Sheet->getStyle('A11')->getFont()->setSize(8); 
$_Sheet->getStyle('A11')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$_Sheet->getStyle('A10')->getFont()->setBold(true);
$_Sheet->getStyle('A12')->getFont()->setBold(true);
$_Sheet->getStyle('A13')->getFont()->setBold(true);

// Header: right
$vom = date('d.m.Y',strtotime($billData -> payment_date -> vom));
$bis = date('d.m.Y',strtotime($billData -> payment_date -> bis));

$_Sheet->setCellValue("L10", "Leistungszeitraum vom $vom bis $bis");
$_Sheet->setCellValue("L12", $billData -> invoice_number);
$_Sheet->setCellValue("L13", date('d.m.Y',strtotime($billData -> created)));


$_Sheet->getStyle('L10')->getFont()->setSize(8); 

$_Sheet->getStyle('L10')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
$_Sheet->getStyle('L12')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
$_Sheet->getStyle('L13')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

$_Sheet->getStyle('L12')->getFont()->setBold(true);
$_Sheet->getStyle('L13')->getFont()->setBold(true);

// Header: bootum

$_Sheet->setCellValue("A15", $billData -> number_bill);

$styleArray = array(
	'borders' => array(
		'bottom' => array(
			'style' => PHPExcel_Style_Border::BORDER_THIN,
			'color' => array('argb' => '000'),
		),
	),
);
$_Sheet->getStyle('A15:L15')->applyFromArray($styleArray);

$_Sheet->mergeCells("F17:L17");
$_Sheet->setCellValue("F17", $billData -> greeting_phrase);					
$_Sheet->getRowDimension(17)->setRowHeight(50);
$_Sheet->getStyle('F17')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);


$_Sheet->getStyle('A18:L18')->applyFromArray($styleArray);

// content
$row = 19;
item_bill_header($row, "I.", "Grundleistungen"); $row++;
render_objects($billData -> objects); $row++;
item_bill_header($row, "II.", "Zusätzliche Leistungen"); $row++;
extraServis($billData); $row++;
item_bill_header($row, "III.", "Nebenkosten"); $row++;
extraCosts($billData); $row++;
item_bill_header($row, "IV.", "Zwischensumme"); $row++;
totalProject($billData); $row++;
item_bill_header($row, "V.", "Gesamt- und Resthonoraranspruch"); $row++;
payments($billData);$row++;
item_bill_header($row, "Rechnungsbetrag", " ", $billData->total_rest); 
$_Sheet->mergeCells("B$row:G$row"); 
$_Sheet->getStyle("L$row")->getNumberFormat()->setFormatCode('#,##0.00_-[$€-x-euro1]'); 
$row++;


// Footer
$row++;
$val_1 = $billData -> total_rest;
$val_2 = $val_1 * ($billData->tax/100);
$val_1 = number_format($val_1, 2);
$val_2 = number_format($val_2, 2);
$val_1 = str_replace(',', ' ', $val_1);
$val_2 = str_replace(',', ' ', $val_2);
$_Sheet->setCellValue("A".$row, "Im Betrag von $val_1 € sind  $val_2 € Mehrwertsteuer enthalten."); $row++;

$pay_date = $billData -> payment_date -> bis;
$pay_date = date('d.M.Y',strtotime($pay_date)) ;
$_Sheet->setCellValue("A".$row, "Bitte zahlen Sie den Betrag bis  zum $pay_date an die unten genannte Bankverbindung."); $row++;

$row++;
$_Sheet->setCellValue("D".$row, "Kontoinhaber");
$_Sheet->setCellValue("H".$row, $billData -> user_name); 
$row++;
$_Sheet->setCellValue("D".$row, "IBAN:"); 
$_Sheet->setCellValue("H".$row, $billData -> user_IBAN); 
$row++;
$_Sheet->setCellValue("D".$row, "BIC"); 
$_Sheet->setCellValue("H".$row, $billData -> user_BIC); 
$row++;
$_Sheet->setCellValue("D".$row, "Institut"); 
$_Sheet->setCellValue("H".$row, $billData -> user_Institut); 
$row++;
$_Sheet->setCellValue("D".$row, "USt-ld.-Nr."); 
$_Sheet->setCellValue("H".$row, $billData -> user_USt);  
$row++;

$row++;
$_Sheet->setCellValue("A".$row, "Gem. § 14b Abs. 1 S.4 Umsatzsteuergesetz muss diese Rechnung und ein Zahlungsbeleg für zwei Jahre aufbewahrt werden. Die Aufbewahrungsfrist beginnt mit dem Ende des Kalenderjahres, in dem die Rechnung ausgestellt wurde.  Ein Verstoß kann nach § 26a Abs. 2 UStG mit bis zu 500 EUR Geldbuße geahndet werden."); 
$_Sheet->getStyle("A$row")->getAlignment()->setWrapText(true);
$_Sheet->mergeCells("A$row:L$row"); 
$_Sheet->getRowDimension($row)->setRowHeight(40);
$_Sheet->getStyle("A$row")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);





//-----------------------------------------------------------------------------

header ("Expires: Mon, 1 Apr 1974 05:00:00 GMT");
header ("Last-Modified: " . gmdate("D,d M Y H:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename={$billData -> project -> name}.xls");

$objWriter = new PHPExcel_Writer_Excel5($theXls);
$objWriter->save("php://output");



?>