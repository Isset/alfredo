<?php

include_once __DIR__ . '/../../src/Alfredo/Autoloader.php';

use Alfredo\Server;
use Alfredo\Payload\Pdf\QueueItem;

$settings = require '../settings.php';
$server  = new Server($settings['url'], $settings['consumerKey'], $settings['secretKey']);
$payload = new QueueItem();
$payload->setIdentifier('8092e365ce1efa5f53e6a0b512355cac45848b89');
try {
    $data = $server->getQueueItem($payload);
    header('Content-type: application/pdf');
    echo $data;
} catch (Exception $e) {
    echo $e->getMessage();
}