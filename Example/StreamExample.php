<?php

include_once __DIR__ . '/../src/Alfredo/Autoloader.php';

use Alfredo\Server;
use Alfredo\Payload\Pdf\Convert;

$server  = new Server('http://pdfapi.lokaal/app_dev.php');
$payload = new Convert();
$payload
        ->addHtml('asdfasdfasdfasdfasdfasfdasdf', array('layout' => 'landscape'))
        ->addPdf(file_get_contents('test/test.pdf'));
try {
    $data = $server->stream($payload);
    header('Content-type: application/pdf');
    echo $data;
} catch (Exception $e) {
    echo $e->getMessage();
}