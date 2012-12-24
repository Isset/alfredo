<?php

include_once __DIR__ . '/../../src/Alfredo/Autoloader.php';

class Test implements Alfredo\Callback\CallableInterface
{

    public function callback(\Alfredo\Callback\Entity $entity)
    {
        var_dump($entity);
    }

}

require '../db/Db.php';

$settings = require '../settings.php';

$db = new Db($settings['database']['dsn'], $settings['database']['username'], $settings['database']['password']);

$callback = new Alfredo\Callback($db);
//add an identifier
$callback->add('418cb4ac68ca26d9686406e456f6a12065026360');
//handle a callback

$data['identifier'] = '418cb4ac68ca26d9686406e456f6a12065026360';
$data['status']     = 'success';

$callback->handle(new Test(), $data);




