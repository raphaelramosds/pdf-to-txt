<?php

require('vendor/autoload.php');
require('env.php');

use raphaelramosds\PdfToTxt\PdfToTxt;

$pdfh = new PdfToTxt('ND', './assets/pdf/102-modelo-nd.pdf', TXT_PATH);
$pdfh->convert();
