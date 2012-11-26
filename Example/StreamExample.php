<?php

include_once __DIR__ . '/../src/Alfredo/Autoloader.php';

use Alfredo\Server;
use Alfredo\Payload\Pdf\Convert;

$server  = new Server('http://pdfapi.lokaal/app_dev.php');
$payload = new Convert();
$payload->setConverter('htmltopdfjava');
$payload
        ->addHtml(file_get_contents('test/temp/flap.html'));
try {
    $data = $server->stream($payload);
    header('Content-type: application/pdf');
    echo $data;
} catch (Exception $e) {
    echo $e->getMessage();
}