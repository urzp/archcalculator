<?php

//  echo 'test';
//  exit;
//  https://honorar.online/php/lib/PHPExcel-1.8/Examples/test.php

// Подключение класса для работы с Excel
require_once($_SERVER['DOCUMENT_ROOT'].'/php/lib/PHPExcel-1.8/Classes/PHPExcel.php');
// Подключение класса для вывода данных в формате Excel
require_once($_SERVER['DOCUMENT_ROOT']."/php/lib/PHPExcel-1.8/Classes/PHPExcel/Writer/Excel5.php");

// Создание объекта класса PHPExcel
$myXls = new PHPExcel();
// Указание на активный лист
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

//img

$mySheet->getColumnDimension('B')->setWidth(40);

$imagePath = $_SERVER['DOCUMENT_ROOT']. '/users/user_2/avatar/1733807917_unnamed.jpg';
		
		
if (file_exists($imagePath)) {
	$logo = new PHPExcel_Worksheet_Drawing();
	$logo->setPath($imagePath);
	$logo->setCoordinates("B2");				
	$logo->setOffsetX(0);
	$logo->setOffsetY(0);	
	$mySheet->getRowDimension(2)->setRowHeight(190);
	$logo->setWorksheet($mySheet);
} 


// HTTP-заголовки
header ("Expires: Mon, 1 Apr 1974 05:00:00 GMT");
header ("Last-Modified: " . gmdate("D,d M Y H:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-type: application/vnd.ms-excel");
header ("Content-Disposition: attachment; filename=myFile.xls");

// Вывод файла
$objWriter = new PHPExcel_Writer_Excel5($myXls);
$objWriter->save("php://output");

?>