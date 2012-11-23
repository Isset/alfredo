<?php

include_once __DIR__ . '/../src/Alfredo/Autoloader.php';

use Alfredo\Server;
use Alfredo\Payload\ConvertPayload;

$server  = new Server('http://pdfapi.lokaal/app_dev.php');
$payload = new ConvertPayload();
$payload->addHtml('asdfasdf')
        ->addUrl('http://www.google.nl')
        ->addHtml('qweqweqwe', array('layout' => 'landscape'))
        ->addCallBack('http://www.google.nl');
try {
    $data = $server->queue($payload);
    echo $data;
} catch (Exception $e) {
    echo $e->getMessage();
}