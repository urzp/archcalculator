<?php

switch ($typeData) {
    case 'FeeTable': include 'read/FeeTable.php'; break;
    case 'Paragraphs': include 'read/Paragraphs.php'; break;
    case 'getHOAI': include 'read/HOAI.php'; break;
    case 'read': include 'read/index.php'; break;
}

?>