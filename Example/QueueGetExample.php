<?php

include_once __DIR__ . '/../src/Alfredo/Autoloader.php';

use Alfredo\Server;
use Alfredo\Payload\Pdf\QueueItem;

$server  = new Server('http://pdfapi.lokaal/app_dev.php');
$payload = new QueueItem();
$payload->setIdentifier('32bc7bccf92ee7658c7f75257612f382b040d193');
try {
    $data = $server->getQueueItem($payload);
    header('Content-type: application/pdf');
    echo $data;
} catch (Exception $e) {
    echo $e->getMessage();
}