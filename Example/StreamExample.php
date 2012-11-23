<?php

include_once __DIR__ . '/../src/Alfredo/Autoloader.php';

use Alfredo\Server;
use Alfredo\Payload\ConvertPayload;

$server  = new Server('http://pdfapi.lokaal/app_dev.php');
$payload = new ConvertPayload();
$payload->addUrl('http://www.google.nl');
try {
    $data = $server->stream($payload);
    header('Content-type: application/pdf');
    echo $data;
} catch (Exception $e) {
    echo $e->getMessage();
}