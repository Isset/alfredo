<?php

namespace Alfredo\Connection;

use Alfredo\Payload\PayloadAbstract;

interface TypeInterface
{

    public function sendPayload($url, PayloadAbstract $payload);
}