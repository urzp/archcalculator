<?php

require_once ($_SERVER['DOCUMENT_ROOT'].'/php/lib/dompdf/autoload.inc.php');
use Dompdf\Dompdf;
$dompdf = new DOMPDF();

$message = "my message";

echo 'ok';

$html = "
<html>
 <body>
  <h1>Hello Dompdf</h1>
  <h3>$message</h3>
 </body>
</html>
";

$dompdf->load_html($html);
$dompdf->render();

$dompdf->stream("doc.pdf");

?>