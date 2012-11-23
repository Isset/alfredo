<?php

include_once __DIR__ . '/../src/Alfredo/Autoloader.php';

use Alfredo\Server;
use Alfredo\Payload\QueuePayload;

$server  = new Server('http://pdfapi.lokaal/app_dev.php');
$payload = new QueuePayload();
$payload->setIdentifier('441daf9bb1b24c4f1e5279f19668316d26320a8d');
try {
    $data = $server->getQueueItem($payload);
    header('Content-type: application/pdf');
    echo $data;
} catch (Exception $e) {
    echo $e->getMessage();
}