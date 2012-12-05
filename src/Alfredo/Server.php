<?php

namespace Alfredo;

use Alfredo\Connection\TypeInterface;
use Alfredo\Connection\Curl\CurlPost;
use Alfredo\Payload\PayloadAbstract;

class Server
{

    private $tokenPath;
    private $api;

    /**
     *
     * @var \Alfredo\Connection\TypeInterface
     */
    private $interface;
    private $token = false;
    private $loginPayload;

    public function __construct($api, $consumerKey, $privateKey, TypeInterface $interface = null)
    {
        $this->tokenPath = __DIR__ . '/Cache/token';
        $this->api       = rtrim($api, '/') . '/';
        if (empty($interface)) {
            $this->interface = new CurlPost();
        } else {
            $this->interface    = $interface;
        }
        $this->loginPayload = new Payload\Login($consumerKey, $privateKey);
    }

    public function queue(PayloadAbstract $payload)
    {
        return $this->sendRequest($this->api . 'api/queue/add', $payload);
    }

    public function stream(PayloadAbstract $payload)
    {
        return $this->sendRequest($this->api . 'api/stream', $payload);
    }

    public function getQueueItem(PayloadAbstract $payload)
    {
        return $this->sendRequest($this->api . 'api/queue/get', $payload);
    }

    private function sendRequest($url, PayloadAbstract $payload, $retried = false)
    {
        $response = $this->interface->sendPayload($url, $payload, array('x-auth-token' => $this->getToken()));
        /* @var $response Alfredo\Connection\ResponseInterface */
        if ($response->getStatusCode() == 200) {
            return $response->getContent();
        } else if ($response->getStatusCode() == 403) {
            if (!$retried) {
                $this->getToken(true);
                return $this->sendRequest($url, $payload, true);
            }
            unlink($this->tokenPath);
        }

        throw new Exception($response->getContent());
    }

    public function setToken($token)
    {
        $this->token = $token;
    }

    public function getToken($reGet = false)
    {
        if ($this->token && !$reGet) {
            return $this->token;
        }
        if (file_exists($this->tokenPath) && !$reGet) {
            return $this->token = file_get_contents($this->tokenPath);
        }

        $response = $this->interface->sendPayload($this->api . 'api/login', $this->loginPayload);

        if ($response->getStatusCode() == 200) {
            $token       = json_decode($response->getContent());
            file_put_contents($this->tokenPath, $token->token);
            return $this->token = $token->token;
        } else {
            throw new Exception($response->getContent());
        }
    }

}
