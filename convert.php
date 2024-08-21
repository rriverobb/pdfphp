<?php
require 'vendor/autoload.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);

// instantiate and use the dompdf class
$dompdf = new Dompdf($options);
$html = '
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" media="screen" href="pdf-style.css">
        
    </head>
    <body>
        <img src="Bold-Business-logo.png" />
        <p style="text-align: center;">Bold Business LLC - 263 13th Ave S - St. Petersburg, FL 33701 - 212-913-9132</p>
    </body>
</html>
';


$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream();
?>