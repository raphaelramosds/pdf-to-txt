<?php

require('../vendor/autoload.php');

use raphaelramosds\PdfToTxt\PdfToTxt;

$pdfh = new PdfToTxt(
    __DIR__ . '/assets/pdf/018-la.pdf',
    __DIR__ . '/assets/txt',
    'LA'
);

// $pdfh->setReloadPdf(false);

$pdfh->convert();
