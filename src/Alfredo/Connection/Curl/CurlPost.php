<?php

namespace Alfredo\Connection\Curl;

use Alfredo\Connection\TypeInterface;
use Alfredo\Payload\PayloadAbstract;

class CurlPost implements TypeInterface
{
    public function sendPayload($url, PayloadAbstract $payload, array $headers = array())
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $this->payloadToPost($payload->getPayload()));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        if (!empty($headers)) {
            $curlHeaders = array();
            foreach ($headers as $key => $value) {
                $curlHeaders[] = $key . ': ' . $value;
            }
            curl_setopt($ch, CURLOPT_HTTPHEADER, $curlHeaders);
        }
        curl_setopt($ch, CURLOPT_HEADER, 0);  // DO NOT RETURN HTTP HEADERS
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  // RETURN THE CONTENTS OF THE CALL
        $content     = curl_exec($ch);

        return new CurlResponse(curl_getinfo($ch, CURLINFO_HTTP_CODE), $content);
    }

    private function payloadToPost($payload)
    {
        $post = array();
        foreach ($payload as $key => $value) {
            if (is_array($value) || is_object($value)) {
                $value  = json_encode($value);
            }
            $post[$key] = $value;
        }
        return $post;
    }
}