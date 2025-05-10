<?php

namespace raphaelramosds\PdfToTxt;

use Imagick;
use Exception;
use InvalidArgumentException;

class PdfToTxt 
{
    public string $filename;
    public string $pdf;

    private string $txt_dirname;
    private string $img_dirname;
    private bool $reloadPdf;

    private array $pages;

    public function __construct (string $filename, string $pdf, string $txt_dirname) 
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
        
        $this->txt_dirname = $txt_dirname;
        $this->img_dirname = __DIR__ ."/tmp/$filename";
        $this->reloadPdf = true;

        $this->pages = [];
    }


    public function convert () 
    {
        if (!$this->reloadPdf) return;

        $this->generateImages();

        $this->generateTxt();
    }

    private function generateImages()
    {
        if (!file_exists($this->img_dirname)) {
            mkdir($this->img_dirname, 0777);
        }

        // Convert each PDF page to JPG
        $imagick = new Imagick();
        $imagick->setResolution(160, 160);
        $imagick->readImage($this->pdf);
        $imagick->writeImages($this->img_dirname . "/page.jpg", false);

        // List all files of report folder
        $files = scandir($this->img_dirname);

        // Filter only JPG pages
        $this->pages = array_filter($files, function ($el) {
            return str_contains($el, 'page');
        });

        echo "Images were successfully generated" . PHP_EOL;
    }

    private function generateTxt ()
    {
        $txt = $this->txt_dirname . "/" . $this->filename . ".txt";
        $file = fopen($txt, "a") or die("Unable to open file");
        
        // Clean text file content
        ftruncate($file, 0);

        // Build TXT file
        for ($i = 0; $i < sizeof($this->pages); $i++) 
        {
            $cmd = "tesseract " . escapeshellarg($this->img_dirname . "/page-{$i}.jpg") . " stdout -l por 2>/dev/null";
            $content = shell_exec($cmd);
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