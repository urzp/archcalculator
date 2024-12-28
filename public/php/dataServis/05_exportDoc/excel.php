<?php

//  https://honorar.online/php/dataServis/05_exportDoc/excel.php


require_once($_SERVER['DOCUMENT_ROOT'].'/php/lib/PHPExcel-1.8/Classes/PHPExcel.php');
require_once($_SERVER['DOCUMENT_ROOT']."/php/lib/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel5.php");

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
$_Sheet->setCellValue("A1", "Viktor Filimonow Architekt – Adressstreet - 00000 City");
$_Sheet->getRowDimension(1)->setRowHeight(30);
$_Sheet->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$_Sheet->getStyle('A1')->getFont()->setSize(8); 

//Logo
$imagePath = $_SERVER['DOCUMENT_ROOT']. '/users/user_2/avatar/1733807917_unnamed.jpg';		
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

$_Sheet->setCellValue("A2", "Customer Company");
$_Sheet->setCellValue("A3", "Customer Name");
$_Sheet->setCellValue("A4", "Street");
$_Sheet->setCellValue("A4", "80339 München");
for($i = 2; $i <= 5; $i++){ $_Sheet->getRowDimension($i)->setRowHeight(12); }
$_Sheet->getStyle('A2:A5')->getFont()->setBold(true);

// Header
// Header: left

$_Sheet->setCellValue("A10", "Project X");
$_Sheet->setCellValue("A11", "Wohnprojekt in [Ort] mit [Anzahl] Wohneinheiten. Moderne Architektur, Fokus auf Nachhaltigkeit und Funktionalität. Attraktive Lage mit guter Anbindung.");
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

$_Sheet->setCellValue("L10", "Leistungszeitraum vom TT.MM.JJ bis TT.MM.JJ");
$_Sheet->setCellValue("L12", "RE0011");
$_Sheet->setCellValue("L13", "26.07.2024");

$_Sheet->getStyle('L10')->getFont()->setSize(8); 

$_Sheet->getStyle('L10')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
$_Sheet->getStyle('L12')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
$_Sheet->getStyle('L13')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

$_Sheet->getStyle('L12')->getFont()->setBold(true);
$_Sheet->getStyle('L13')->getFont()->setBold(true);

// Header: bootum

$_Sheet->setCellValue("A15", "8. Abschlagsrechnung");

$styleArray = array(
	'borders' => array(
		'bottom' => array(
			'style' => PHPExcel_Style_Border::BORDER_THIN,
			'color' => array('argb' => '000'),
		),
	),
);
$_Sheet->getStyle('A15:L15')->applyFromArray($styleArray);

//-----------------------------------------------------------------------------

header ("Expires: Mon, 1 Apr 1974 05:00:00 GMT");
header ("Last-Modified: " . gmdate("D,d M Y H:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=myFile.xls");

$objWriter = new PHPExcel_Writer_Excel5($theXls);
$objWriter->save("php://output");

?>