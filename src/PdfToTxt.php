<?php

namespace raphaelramosds\PdfToTxt;

use Imagick;
use Exception;
use InvalidArgumentException;

use thiagoalessio\TesseractOCR\TesseractOCR;

class PdfToTxt 
{
    public $filename;
    public $pdf;

    private $txt_dir;
    private $reloadPdf;
    private $pages = [];

    public function __construct (string $filename, string $pdf, string $txt_dir) 
    {
        try {
            if (!file_exists($pdf)) {
                return new InvalidArgumentException("Path {$pdf} does not exit");
            }
    
        } catch(Exception $e) {
            echo $e->getMessage();
        }

        $this->filename = $filename;
        $this->pdf = $pdf;
        $this->reloadPdf = true;

        $this->txt_dir = $txt_dir;
    }


    public function convert () 
    {
        if (!$this->reloadPdf) return;

        $this->generateImages();

        $this->generateTxt();
    }

    private function generateImages()
    {
        $img = IMG_PATH . "/" . $this->filename;

        if (!file_exists($img)) {
            mkdir($img, 0777);
        }

        // Convert each PDF page to JPG
        $imagick = new Imagick();
        $imagick->setResolution(160, 160);
        $imagick->readImage($this->pdf);
        $imagick->writeImages($img . "/page.jpg", false);

        // List all files of report folder
        $files = scandir($img);

        // Filter only JPG pages
        $this->pages = array_filter($files, function ($el) {
            return str_contains($el, 'page');
        });

        echo "Images were successfully generated on {$img}" . PHP_EOL;
    }

    private function generateTxt ()
    {
        $txt = $this->txt_dir . "/" . $this->filename . ".txt";

        $file = fopen($txt, "a") or die("Unable to open file");
        
        // Clean text file content
        ftruncate($file, 0);

        // Build TXT file
        for ($i = 0; $i < sizeof($this->pages); $i++) 
        {
            $tocr = new TesseractOCR(IMG_PATH . "/" . $this->filename . "/page-{$i}.jpg");
            $content = $tocr
                ->lang('por')
                ->run();
            fwrite($file, $content . PHP_EOL);
        }

        fclose($file);

        echo "TXT successfully generated on {$txt}" . PHP_EOL;

        return $txt;
    }

    public function setReloadPdf ($val = true)
    {
        $this->reloadPdf = $val;
    }
}