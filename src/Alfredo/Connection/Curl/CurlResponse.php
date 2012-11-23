<?php

namespace Alfredo\Connection\Curl;

use Alfredo\Connection\ResponseInterface;

class CurlResponse implements ResponseInterface
{

    private $content;
    private $statusCode;

    public function __construct($statusCode, $content)
    {
        $this->statusCode = $statusCode;
        $this->content    = $content;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function setContent($statusCode)
    {
        $this->statusCode = $statusCode;
    }

    public function setStatusCode($content)
    {
        $this->content = $content;
    }

}