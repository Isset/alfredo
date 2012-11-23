<?php

namespace Alfredo;

use Alfredo\Connection\TypeInterface;
use Alfredo\Connection\Curl\CurlPost;
use Alfredo\Payload\PayloadAbstract;

class Server
{

    private $api;

    /**
     *
     * @var \Alfredo\Connection\TypeInterface
     */
    private $interface;

    public function __construct($api, TypeInterface $interface = null)
    {
        $this->api = rtrim($api, '/') . '/';
        if (empty($interface)) {
            $this->interface = new CurlPost();
        } else {
            $this->interface = $interface;
        }
    }

    public function queue(PayloadAbstract $payload)
    {
        return $this->sendRequest($this->api . 'queue/add', $payload);
    }

    public function stream(PayloadAbstract $payload)
    {
        return $this->sendRequest($this->api . 'stream', $payload);
    }

    public function getQueueItem(PayloadAbstract $payload)
    {
        return $this->sendRequest($this->api . 'queue/get', $payload);
    }

    private function sendRequest($url, PayloadAbstract $payload)
    {
        $response = $this->interface->sendPayload($url, $payload);
        /* @var $response Alfredo\Connection\ResponseInterface */
        if ($response->getStatusCode() == 200) {
            return $response->getContent();
        } else {
            throw new Exception($response->getContent());
        }
    }

}
