<?php

require('../vendor/autoload.php');

use raphaelramosds\PdfToTxt\PdfToTxt;

$pdfh = new PdfToTxt(
    'ND', 
    __DIR__ . '/assets/pdf/102-modelo-nd.pdf',
    __DIR__ . '/assets/txt'
);

// $pdfh->setReloadPdf(false);

$pdfh->convert();
