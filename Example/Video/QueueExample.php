<?php

include_once __DIR__ . '/../../src/Alfredo/Autoloader.php';

use Alfredo\Server;
use Alfredo\Payload\Video\Convert;

$settings = require '../settings.php';
$server  = new Server($settings['url'], $settings['consumerKey'], $settings['secretKey']);
$payload = new Convert();
$payload->addVideo(__DIR__.'/test/test.avi');

try {
    $data = $server->queue($payload);
    echo $data;
} catch (Exception $e) {
    echo $e->getMessage();
}