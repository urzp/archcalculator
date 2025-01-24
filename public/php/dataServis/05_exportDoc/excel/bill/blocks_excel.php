<?php

function item_bill_header($row, $number, $title, $value =''){
    global $_Sheet, $styleArray;
    $row_ = $row - 1;
    $_Sheet->setCellValue("B".$row, $number);
    $_Sheet->setCellValue("F".$row, $title);
    $_Sheet->getStyle("A$row:L$row")->getFont()->setBold(true);
    $_Sheet->getStyle("A$row_:L$row_")->applyFromArray($styleArray);
    $_Sheet->getStyle("A$row:L$row")->applyFromArray($styleArray);
    $_Sheet->setCellValue("L".$row, $value );
}

function render_objects($objects){
    global $_Sheet, $styleArray, $billData,  $row;
    foreach($objects as $index => $obj){
        base_obj($index, $obj);
        base_servis_obj($index, $obj);
        extra_servis_obj($index, $obj);

        //total
        $row++;
        $_Sheet->setCellValue("D".$row, "Summ as Honorarobjekt"); 
        $_Sheet->setCellValue("L".$row, $obj -> total ); 
    
        $_Sheet->getStyle("D$row:L$row")->getFont()->setBold(true);
        $_Sheet->getStyle("L$row")->getNumberFormat()->setFormatCode('#,##0.00_-[$€-x-euro1]'); 
        $row++;
    }

    if(count($objects) <= 1) return false;
    //Summ as alles Honorarobjekt
    $row++;
    $_Sheet->setCellValue("A".$row, "Summ as alles Honorarobjekt"); 
    $_Sheet->setCellValue("L".$row, $billData -> total_objects ); 

    $_Sheet->getStyle("A$row:L$row")->getFont()->setBold(true);
    $_Sheet->getStyle("L$row")->getNumberFormat()->setFormatCode('#,##0.00_-[$€-x-euro1]'); 
    $row++;
}

function base_obj($index, $obj){
    global $_Sheet, $styleArray, $row;

    //header
    $index_leter = number_to_leter($index + 1);
    $_Sheet->setCellValue("C".$row, $index_leter); 
    $_Sheet->setCellValue("F".$row, "Honorarobjekt"); 
    $_Sheet->setCellValue("K".$row,  $obj -> name); 

    $_Sheet->getStyle("A$row:L$row")->getFont()->setBold(true);
    $_Sheet->getStyle("K".$row)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
    $row++;
    //1.Honorarzone und Honorarsatz
    $_Sheet->setCellValue("D".$row, "1. "); 
    $_Sheet->setCellValue("F".$row, "Honorarzone und Honorarsatz"); 
    $_Sheet->setCellValue("J".$row, $obj -> honorar_zone); 
    $_Sheet->setCellValue("K".$row,  $obj -> honorar_satz); 
    $_Sheet->getStyle("H$row:L$row")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
    $row++;
    //2.Anrechenbaren Kosten
    $_Sheet->setCellValue("D".$row, "2. "); 
    $_Sheet->setCellValue("F".$row, "Anrechenbaren Kosten"); 
    $_Sheet->setCellValue("K".$row,  $obj -> costs); 
    $_Sheet->getStyle("H$row:L$row")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
    $_Sheet->getStyle("K$row")->getNumberFormat()->setFormatCode('#,##0.00_-[$€-x-euro1]'); 
    $row++;
    //3.Rechnerisches Gesamthonorar LPH 1-9
    $_Sheet->setCellValue("D".$row, "3. "); 
    $_Sheet->setCellValue("F".$row, "Rechnerisches Gesamthonorar LPH 1-9"); 
    $_Sheet->setCellValue("K".$row,  $obj -> honorar_total); 
    $_Sheet->getStyle("K$row")->getFont()->setBold(true);
    $_Sheet->getStyle("H$row:L$row")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
    $_Sheet->getStyle("K$row")->getNumberFormat()->setFormatCode('#,##0.00_-[$€-x-euro1]'); 
    $row++;
    //4.Ermittlung Leistungsstand
    $_Sheet->setCellValue("D".$row, "4. "); 
    $_Sheet->setCellValue("F".$row, "Ermittlung Leistungsstand"); 
    $row++;
}

function base_servis_obj($index, $obj){
    global $_Sheet, $styleArray, $row;

    //header
    $row++;
    $_Sheet->setCellValue("G".$row, "Leistungsphase"); 
    $_Sheet->setCellValue("H".$row, "beauftragt");
    $_Sheet->setCellValue("I".$row, "geleistet");
    $_Sheet->setCellValue("J".$row, "Faktor");
    $_Sheet->getStyle("H$row:L$row")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $_Sheet->getStyle("G$row:L$row")->applyFromArray($styleArray);
    $row++;
    //content
    foreach($obj->stages as $i => $item){
        $_Sheet->setCellValue("G".$row, $item -> name); 
        $_Sheet->setCellValue("H".$row, $item -> percent);
        $_Sheet->setCellValue("I".$row, $item -> done);
        $_Sheet->setCellValue("J".$row, $item -> factor);
        $_Sheet->setCellValue("K".$row, $item -> total);

        $_Sheet->getStyle("G$row")->getAlignment()->setWrapText(true);
        $_Sheet->getStyle("H$row:L$row")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $_Sheet->getStyle("H$row:L$row")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $_Sheet->getStyle("H$row")->getNumberFormat()->setFormatCode('#,##0.00_-[$%]'); 
        $_Sheet->getStyle("I$row")->getNumberFormat()->setFormatCode('#,##0.00_-[$%]'); 
        $_Sheet->getStyle("J$row")->getNumberFormat()->setFormatCode('#,##0.00'); 
        $_Sheet->getStyle("K$row")->getNumberFormat()->setFormatCode('#,##0.00_-[$€-x-euro1]'); 
        $row++;
    }
    //total
    $total = $obj->stages_total;
    $i++;
    $_Sheet->setCellValue("G".$row, "Summe aus $i"); 
    $_Sheet->setCellValue("H".$row, $total -> percent);
    $_Sheet->setCellValue("I".$row, $total -> done);
    $_Sheet->setCellValue("L".$row, $total -> price); 

    $_Sheet->getStyle("G$row:L$row")->getFont()->setBold(true);
    $_Sheet->getStyle("H$row")->getNumberFormat()->setFormatCode('#,##0.00_-[$%]'); 
    $_Sheet->getStyle("I$row")->getNumberFormat()->setFormatCode('#,##0.00_-[$%]'); 
    $_Sheet->getStyle("L$row")->getNumberFormat()->setFormatCode('#,##0.00_-[$€-x-euro1]'); 
    $_Sheet->getStyle("G$row:L$row")->applyFromArray($styleArray);
    $row++;
}

function extra_servis_obj($index, $obj){
    global $_Sheet, $styleArray, $row;
    if( count($obj -> stagesExtra) == 0 ) return false;
    //5.Besondere Leistungen
    $row++;
    $_Sheet->setCellValue("D".$row, "5. "); 
    $_Sheet->setCellValue("F".$row, "Ermittlung Leistungsstand"); 
    $row++;

    //header
    $row++;
    $_Sheet->setCellValue("G".$row, "Sonderleistungen"); 
    $_Sheet->getStyle("G$row:L$row")->applyFromArray($styleArray);
    $row++;

    foreach($obj->stagesExtra as $i => $item){
        $_Sheet->setCellValue("G".$row, $item -> title); 
        $_Sheet->setCellValue("H".$row, $item -> percent);
        $_Sheet->setCellValue("K".$row, $item -> total );    

        $_Sheet->getStyle("G$row")->getAlignment()->setWrapText(true);
        $_Sheet->getStyle("H$row:L$row")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $_Sheet->getStyle("H$row:L$row")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $_Sheet->getStyle("H$row")->getNumberFormat()->setFormatCode('#,##0.00_-[$%]'); 
        $_Sheet->getStyle("I$row")->getNumberFormat()->setFormatCode('#,##0.00_-[$%]'); 
        $_Sheet->getStyle("J$row")->getNumberFormat()->setFormatCode('#,##0.00'); 
        $_Sheet->getStyle("K$row")->getNumberFormat()->setFormatCode('#,##0.00_-[$€-x-euro1]');    
        $row++;
    }
        //total
        $i++;
        $_Sheet->setCellValue("G".$row, "Summe aus $i"); 
        $_Sheet->setCellValue("L".$row, $obj -> stagesExtraTotal ); 
    
        $_Sheet->getStyle("G$row:L$row")->getFont()->setBold(true);
        $_Sheet->getStyle("L$row")->getNumberFormat()->setFormatCode('#,##0.00_-[$€-x-euro1]'); 
        $_Sheet->getStyle("G$row:L$row")->applyFromArray($styleArray);
        $row++;
}

function extraServis($billData){
    global $_Sheet, $styleArray, $row;

    foreach($billData->extraServis as $i => $item){
        $_Sheet->setCellValue("F".$row, $item -> title); 

        $_Sheet->setCellValue("I".$row, $item -> hours);
        $_Sheet->setCellValue("J".$row, $item -> price_hours);
        $_Sheet->setCellValue("K".$row, $item -> total );    

        $_Sheet->getStyle("H$row:L$row")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $_Sheet->getStyle("I$row")->getNumberFormat()->setFormatCode('#,##0.00_-[$h]'); 
        $_Sheet->getStyle("J$row")->getNumberFormat()->setFormatCode('#,##0.00_-[$€h]'); 
        $_Sheet->getStyle("K$row")->getNumberFormat()->setFormatCode('#,##0.00_-[$€-x-euro1]');  
        $row++;     
    }
    //total
    $i++;
    $_Sheet->setCellValue("F".$row, "Summe aus $i"); 
    $_Sheet->setCellValue("L".$row, $billData -> totalExtraServis ); 

    $_Sheet->getStyle("F$row:L$row")->getFont()->setBold(true);
    $_Sheet->getStyle("L$row")->getNumberFormat()->setFormatCode('#,##0.00_-[$€-x-euro1]'); 
    $row++;
}

function extraCosts($billData){
    global $_Sheet, $styleArray, $row;

    foreach($billData->extraCosts as $i => $item){
        $_Sheet->setCellValue("F".$row, $item -> title); 

        $_Sheet->setCellValue("I".$row, $item -> rate);
        $_Sheet->setCellValue("J".$row, $item -> price_rate);
        $_Sheet->setCellValue("K".$row, $item -> total );    

        $_Sheet->getStyle("H$row:L$row")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
        $_Sheet->getStyle("I$row")->getNumberFormat()->setFormatCode('#,##0.00'); 
        $_Sheet->getStyle("J$row")->getNumberFormat()->setFormatCode('#,##0.00_-[$€]'); 
        $_Sheet->getStyle("K$row")->getNumberFormat()->setFormatCode('#,##0.00_-[$€-x-euro1]');  
        $row++;     
    }
    //total
    $i++;
    $_Sheet->setCellValue("F".$row, "Summe aus $i"); 
    $_Sheet->setCellValue("L".$row, $billData -> totalExtraCosts ); 

    $_Sheet->getStyle("F$row:L$row")->getFont()->setBold(true);
    $_Sheet->getStyle("L$row")->getNumberFormat()->setFormatCode('#,##0.00_-[$€-x-euro1]'); 
    $row++;
}

function totalProject($billData){
    global $_Sheet, $styleArray, $row;
    $_Sheet->setCellValue("D".$row, "1. "); 
    $_Sheet->setCellValue("F".$row, "Zwischensumme Netto-Honorare einschließlich Nebenkosten"); 
    $_Sheet->setCellValue("L".$row, $billData->total_net); 
    $_Sheet->getStyle("A$row:L$row")->getFont()->setBold(true);
    $_Sheet->getStyle("L$row")->getNumberFormat()->setFormatCode('#,##0.00_-[$€-x-euro1]'); 
    $row++;

    $_Sheet->setCellValue("D".$row, "2. "); 
    $_Sheet->setCellValue("F".$row, "Umsatzsteuer"); 
    $_Sheet->setCellValue("H".$row, $billData->tax); 
    $_Sheet->setCellValue("L".$row, $billData->total_tax);
    $_Sheet->getStyle("A$row:L$row")->getFont()->setBold(true);
    $_Sheet->getStyle("H$row")->getNumberFormat()->setFormatCode('#,##0.00_-[$%]'); 
    $_Sheet->getStyle("L$row")->getNumberFormat()->setFormatCode('#,##0.00_-[$€-x-euro1]'); 
    $row++;

    $_Sheet->setCellValue("D".$row, "3. "); 
    $_Sheet->setCellValue("F".$row, "Brutto-Honorar einschließlich Nebenkosten"); 
    $_Sheet->setCellValue("L".$row, $billData->total);
    $_Sheet->getStyle("D$row:L$row")->getFont()->setBold(true);
    $_Sheet->getStyle("L$row")->getNumberFormat()->setFormatCode('#,##0.00_-[$€-x-euro1]'); 
    $row++;

}

function payments($billData){
    global $_Sheet, $styleArray, $row;

    $_Sheet->setCellValue("D".$row, "1. "); 
    $_Sheet->setCellValue("F".$row, "Rechnerisches Gesamthonorar"); 
    $_Sheet->setCellValue("L".$row, $billData->total); 
    $_Sheet->getStyle("L$row")->getNumberFormat()->setFormatCode('#,##0.00_-[$€-x-euro1]'); 
    $row++;

    $_Sheet->setCellValue("D".$row, "2. "); 
    $_Sheet->setCellValue("F".$row, "Abzüge für geleistete Abschlagszahlungen"); 
    $row++;
    priviosPayments($billData->paid->previous);

    $_Sheet->getStyle("H$row")->getNumberFormat()->setFormatCode('#,##0.00_-[$%]'); 
    $_Sheet->getStyle("L$row")->getNumberFormat()->setFormatCode('#,##0.00_-[$€-x-euro1]'); 
    $row++;

    $_Sheet->setCellValue("D".$row, "3. "); 
    $_Sheet->setCellValue("F".$row, "Restlicher Honoraranspruch"); 
    $_Sheet->setCellValue("L".$row, $billData->total_rest);
    $_Sheet->getStyle("D$row:L$row")->getFont()->setBold(true);
    $_Sheet->getStyle("L$row")->getNumberFormat()->setFormatCode('#,##0.00_-[$€-x-euro1]'); 
    
    $row++;

}

function priviosPayments($list){
    global $_Sheet, $styleArray, $row;

    $summ = 0;
    foreach ($list as $index => $item){
        $_Sheet->setCellValue("G".$row, $item->invoice_number); 
        $_Sheet->setCellValue("H".$row, date('d.m.Y',strtotime($item->date) ) );
        $_Sheet->setCellValue("I".$row, "Zahlung vom");
        $_Sheet->setCellValue("K".$row, $item->value);
        $_Sheet->getStyle("K$row")->getNumberFormat()->setFormatCode('#,##0.00_-[$€-x-euro1]'); 
        $summ=$summ+$item->value;
        $row++;
    }

    $summ=$summ*(-1);
    $_Sheet->setCellValue("G".$row, "Summe");
    $_Sheet->setCellValue("L".$row, $summ);
    $_Sheet->getStyle("L$row")->getNumberFormat()->setFormatCode('#,##0.00_-[$€-x-euro1]'); 
}

?>