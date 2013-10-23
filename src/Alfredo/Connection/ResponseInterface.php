<?php

namespace Alfredo\Connection;

interface ResponseInterface
{
    public function setStatusCode($statusCode);

    public function setContent($content);

    public function getStatusCode();

    public function getContent();
}