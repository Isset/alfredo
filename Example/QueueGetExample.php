<?php

include_once __DIR__ . '/../src/Alfredo/Autoloader.php';

use Alfredo\Server;
use Alfredo\Payload\Pdf\QueueItem;

$server  = new Server('http://converter.isset.nl', 'c29e794de76c0690ba09c610bfb05ea1f85c343c', 'bbec6637426a9ec44d4b609aac44a1ff42809609');
$payload = new QueueItem();
$payload->setIdentifier('2132ab8d516a5e2940cfa3f6886362300d19048e');
try {
    $data = $server->getQueueItem($payload);
    header('Content-type: application/pdf');
    echo $data;
} catch (Exception $e) {
    echo $e->getMessage();
}