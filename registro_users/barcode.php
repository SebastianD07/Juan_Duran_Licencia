<?php
require_once '../vendor/autoload.php';

use Picqer\Barcode\BarcodeGeneratorPNG;

if (isset($_GET['text'])) {
    $code = $_GET['text'];
    $generator = new BarcodeGeneratorPNG();

    header('Content-type: image/png');
    echo $generator->getBarcode($code, $generator::TYPE_CODE_128);
    exit;
}
?>