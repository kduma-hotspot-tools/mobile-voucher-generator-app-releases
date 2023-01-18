<?php

require __DIR__ . '/vendor/autoload.php';

use Mike42\Escpos\PrintConnectors\DummyPrintConnector;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\Printer;

$connector = new FilePrintConnector("sunmi.raw");
$printer = new Printer($connector);

$printer->setJustification(Printer::JUSTIFY_CENTER);
$printer->setTextSize(2, 3);
$printer->text("{{plan.name}}\n");
$printer->setTextSize(2, 2);
$printer->selectPrintMode();
$printer->setEmphasis(true);
$printer->text("Internet Access Card\n");
$printer->setTextSize(1, 1);
$printer->setEmphasis(false);

$printer->feed();

$printer->setJustification(Printer::JUSTIFY_LEFT);
$printer->text("Plan ID: {{plan.id}}\n");
$printer->text("Name: {{plan.name}}\n");
$printer->text("Description: {{plan.description}}\n");
$printer->text("Devices: {{plan.use_limit}}\n");
$printer->text("Time: {{plan.valid_minutes}}\n");
$printer->text("Data: {{plan.data_quota}}\n");
$printer->text("Upload: {{plan.upload_speed}}\n");
$printer->text("Download: {{plan.download_speed}}\n");
$printer->setJustification(Printer::JUSTIFY_CENTER);

$printer->feed();

$printer->text("To use internet, please connect\nto WiFi network named:\n");

$printer->feed();
$printer->setEmphasis(true);
$printer->setReverseColors(true);
$printer->setTextSize(2, 2);
$printer->text("{{wifi}}\n");
$printer->setTextSize(1, 1);
$printer->setReverseColors(false);
$printer->setEmphasis(false);
$printer->feed();

$printer->text("when you will be redirected to\ncaptive portal or login screen,\nenter your voucher code:\n");
$printer->feed();

$printer->setTextSize(2, 3);
$printer->setEmphasis(true);
$printer->setReverseColors(true);
$printer->text("{{code}}\n");
$printer->setReverseColors(false);
$printer->setEmphasis(false);
$printer->selectPrintMode();

$printer->feed();
$printer->text("Please activate voucher before:\n");
$printer->setEmphasis(true);
$printer->text("{{expires}}\n");
$printer->setEmphasis(false);
$printer->feed();
$printer->text("{{id}}\n");

$printer->feed();
$printer->feed();

$printer -> cut(Printer::CUT_PARTIAL);

$printer -> close();

echo base64_encode(file_get_contents("sunmi.raw"));