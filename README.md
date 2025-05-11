# PdfToTxt

PdfToTxt is a simple package for converting a PDF file into TXT with PHP

```bash
composer require raphaelramosds/pdf-to-txt
```

## Example

Converts `file.pdf` into `file.txt` and save it on `path/to/txt directory`

```php
$ptt = new PdfToTxt('path/to/file.pdf', 'path/to/txt', 'file');
$ptt->convert();
```

## How does it work?

It uses ImageMagick to convert all PDF pages into JPG format, extracts their content using Tesseract OCR and compiles the results into a single TXT file.

### Ghostscript support?

While some PDF files use standard fonts that can be easily mapped to text, others rely on custom fonts—such as Type 3—which often store characters as vector graphics. In such cases, OCR becomes necessary to extract readable content. Therefore, in the future, I plan to add Ghostscript support to this package as an alternative method for handling these PDFs without relying solely on OCR.

You can use the following Ghostscript command to convert a PDF into a plain text file:

```bash
gs -sDEVICE=txtwrite -o file.txt file.pdf
```

Before using this approach, it's recommended to check which fonts are used in the PDF. You can do that with the following command:

```bash
gs -DPDFINFO file.pdf
```

## Dependencies

Unfortunately, this package can only be used in a Linux environment. Additionally, you will need to install the following dependencies:

### Tesseract OCR package

```bash
# Install Tesseract OCR and its support to PT-BR language
sudo apt install tesseract-ocr tesseract-ocr-por
```

### ImageMagick

```bash
# Install
sudo apt install imagemagick php-imagick

# Enable imagick extension
sudo phpenmod imagick

# (Optional) Check if it is enabled
php -m | grep imagick
```
