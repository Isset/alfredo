<?php

include_once __DIR__ . '/../../src/Alfredo/Autoloader.php';

use Alfredo\Server;
use Alfredo\Payload\Pdf\Convert;

$settings = require '../settings.php';
$server  = new Server($settings['url'], $settings['consumerKey'], $settings['secretKey']);
$payload = new Convert();
$payload
        ->addHtml(file_get_contents('test/test.html'))
        ->setCallback('http://test.lokaal');
try {
    $data = $server->queue($payload);
    echo $data;
} catch (Exception $e) {
    echo $e->getMessage();
}