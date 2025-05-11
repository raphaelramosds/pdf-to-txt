# PdfToTxt

PdfToTxt is a simple package for converting a PDF file into TXT with PHP

```bash
composer require raphaelramosds/pdf-to-txt
```

## Example

Converts a `file.pdf` into `file.txt` and save it on `path/to/txt directory`

```php
$pdfh = new PdfToTxt(
    'path/to/file.pdf',
    'path/to/txt'
    'file',
);
```

## How does it work?

It uses ImageMagick to convert all PDF pages into JPG format, extracts their content using Tesseract OCR and compiles the results into a single TXT file.

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