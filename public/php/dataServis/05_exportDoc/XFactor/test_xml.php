<?php
// https://honorar.online/php/dataServis/05_exportDoc/XFactor/test_xml.php
// Устанавливаем заголовки для скачивания XML-файла
header('Content-Type: application/xml');
header('Content-Disposition: attachment; filename="sample.xml"');

// Создаем объект SimpleXMLElement
$xml = new SimpleXMLElement('<root/>');

// Данные для добавления в XML
$data = [
    ['name' => 'John Doe', 'age' => 30],
    ['name' => 'Jane Smith', 'age' => 25],
];

// Добавляем данные в XML
foreach ($data as $person) {
    $personXml = $xml->addChild('person');
    $personXml->addChild('name', $person['name']);
    $personXml->addChild('age', $person['age']);
}

// Выводим XML
print $xml->asXML();
?>