<?php
require("html2pdf/dompdf_config.inc.php");

$html = file_get_contents("quotation_print.php");
$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream("sample.pdf");

?>