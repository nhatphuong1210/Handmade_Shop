<?php

require 'vendor/autoload.php';

use Dompdf\Adapter\CPDF;
use Dompdf\Dompdf;
use Dompdf\Exception;
use Dompdf\FontMetrics;

if (php_sapi_name() !== 'cli') {
    echo "This script must be run from the command line.\n";
    exit(1);
}

if ($argc < 4) {
    echo "Usage: php load_font.php <font-name> <path-to-ttf-file> <output-directory>\n";
    exit(1);
}

list(, $fontName, $ttfPath, $outputDir) = $argv;

if (!file_exists($ttfPath)) {
    echo "Font file not found: $ttfPath\n";
    exit(1);
}

if (!is_dir($outputDir)) {
    echo "Output directory not found: $outputDir\n";
    exit(1);
}

$dompdf = new Dompdf();
$fontMetrics = new FontMetrics($dompdf->getCanvas(), $dompdf->getOptions());

try {
    $fontMetrics->registerFont($fontName, [
        'normal' => $ttfPath,
        'bold' => $ttfPath,
        'italic' => $ttfPath,
        'bold_italic' => $ttfPath,
    ], $outputDir);
    echo "Font '$fontName' registered successfully.\n";
} catch (Exception $e) {
    echo "Failed to register font: " . $e->getMessage() . "\n";
}
