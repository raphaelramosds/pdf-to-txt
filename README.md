# PdfToTxt

PdfToTxt is a simple package for converting a PDF file into TXT with PHP

```bash
composer require raphaelramosds/pdf-to-txt
```

> This package was published on [Packagist](https://packagist.org/)

## Dependencies

### Image Magick

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