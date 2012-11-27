<?php

include_once __DIR__ . '/../src/Alfredo/Autoloader.php';

use Alfredo\Server;
use Alfredo\Payload\Pdf\Convert;

$server  = new Server('http://converter.isset.nl', 'c29e794de76c0690ba09c610bfb05ea1f85c343c', 'bbec6637426a9ec44d4b609aac44a1ff42809609');
$payload = new Convert();
$payload->addHtml(file_get_contents('test/test.html'));
try {
    $data = $server->queue($payload);
    echo $data;
} catch (Exception $e) {
    echo $e->getMessage();
}