<?php
/**
 * PHPExcel
 *
 * Copyright (c) 2006 - 2015 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2015 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    ##VERSION##, ##DATE##
 */

/** Error reporting */

//  https://honorar.online/php/dataServis/05_exportDoc/pdf.php

// error_reporting(E_ALL);
// ini_set('display_errors', TRUE);
// ini_set('display_startup_errors', TRUE);
// date_default_timezone_set('Europe/London');

// if (PHP_SAPI == 'cli')
// 	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once($_SERVER['DOCUMENT_ROOT'].'/php/lib/PHPExcel-1.8/Classes/PHPExcel.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/php/lib/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php');


//	Change these values to select the Rendering library that you wish to use
//		and its directory location on your server
//$rendererName = PHPExcel_Settings::PDF_RENDERER_TCPDF;
//$rendererName = PHPExcel_Settings::PDF_RENDERER_MPDF;
$rendererName = PHPExcel_Settings::PDF_RENDERER_DOMPDF;
//$rendererLibrary = 'TCPDF-main';
//$rendererLibrary = 'mpdf';//'mPDF5.4';
$rendererLibrary = 'dompdf'; //'domPDF0.6.0beta3';
$rendererLibraryPath = $_SERVER['DOCUMENT_ROOT'].'/php/lib/' . $rendererLibrary;


// Create new PHPExcel object
$myXls = new PHPExcel();

// Set document properties


// Add some data
$myXls->setActiveSheetIndex(0);
// Получение активного листа
$mySheet = $myXls->getActiveSheet();
// Указание названия листа книги
$mySheet->setTitle("Новый лист");

// Указываем значения для отдельных ячеек
$mySheet->setCellValue("A1", "1-я строка");
$mySheet->setCellValue("A2", "2-я строка");
$mySheet->setCellValue("A3", "3-я строка");
$mySheet->setCellValue("B1", "2-й столбец");

$mySheet->getColumnDimension('B')->setWidth(40);


if (!PHPExcel_Settings::setPdfRenderer(
		$rendererName,
		$rendererLibraryPath
	)) {
	die(
		'NOTICE: Please set the $rendererName and $rendererLibraryPath values' .
		'<br />' .
		'at the top of this script as appropriate for your directory structure'
	);
}


// // Redirect output to a client’s web browser (PDF)
header('Content-Type: application/pdf');
header('Content-Disposition: attachment;filename="01simple.pdf"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($myXls, 'PDF');
$objWriter->save('php://output');

//--------------------------excel---------------------

// HTTP-заголовки
// header ("Expires: Mon, 1 Apr 1974 05:00:00 GMT");
// header ("Last-Modified: " . gmdate("D,d M Y H:i:s") . " GMT");
// header ("Cache-Control: no-cache, must-revalidate");
// header ("Pragma: no-cache");
// header ("Content-type: application/vnd.ms-excel");
// header ("Content-Disposition: attachment; filename=myFile.xls");

// // Вывод файла
// $objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
// $objWriter->save("php://output");

//----------------------------------------------------

?>