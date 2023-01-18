<?php

require __DIR__ . '/vendor/autoload.php';

use Mike42\Escpos\PrintConnectors\DummyPrintConnector;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\Printer;

$connector = new FilePrintConnector("sunmi_label.raw");
$printer = new Printer($connector);

$printer->setJustification(Printer::JUSTIFY_CENTER);

$printer->setTextSize(2, 2);
$printer->text("WiFi Access Code\n");
$printer->setEmphasis(true);
$printer->setTextSize(2, 1);
$printer->text("{{plan.name}}\n");
$printer->setEmphasis(false);
$printer->setTextSize(2, 4);
$printer->text("{{code}}\n");
$printer->setTextSize(1, 1);
$printer->setEmphasis(true);
$printer->text("{{expires}}\n");
$printer->setEmphasis(false);

$printer -> close();

echo base64_encode(file_get_contents("sunmi_label.raw"));