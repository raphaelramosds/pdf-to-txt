# PdfToTxt

PdfToTxt is a simple package for converting a PDF file into TXT with PHP

```bash
composer require raphaelramosds/pdf-to-txt
```

## How does it work?

It uses ImageMagick to convert all PDF pages into JPG format, extracts their content using the PHP wrapper for Tesseract, available in [thiagoalessio/tesseract_ocr](https://packagist.org/packages/thiagoalessio/tesseract_ocr), and compiles the results into a single TXT file.

## Dependencies

Unfortunately, this package can only be used in a Linux environment. Additionally, you will need to install the following dependencies:

### ImageMagick

```bash
# Install
sudo apt install imagemagick php-imagick

# Enable imagick extension
sudo phpenmod imagick

# (Optional) Check if it is enabled
php -m | grep imagick
```

### Tesseract OCR

```bash
# Install Tesseract OCR and its support to PT-BR language
sudo apt install tesseract-ocr tesseract-ocr-por
```