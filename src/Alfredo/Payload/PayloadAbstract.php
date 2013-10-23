<?php

namespace Alfredo\Payload;

abstract class PayloadAbstract
{
    protected $payload = array();

    abstract function getType();

    public function addData($data, $type, $options = array())
    {
        $this->payload['data'][] = array('data' => $data, 'type' => $type, 'options' => $options);
        return $this;
    }

    public function setSetting($setting, $value)
    {
        $this->payload[$setting] = $value;
        return $this;
    }

    public function getPayload()
    {
        return $this->payload;
    }

    public function addIdentifier($identifier, array $options = array()){
        $this->addData($identifier, 'identifier', $options);
        return $this;
    }

    /**
     *
     * @param string $url
     * @return Convert
     */
    public function setCallBack($url)
    {
        return $this->setSetting('callback', $url);
    }

    /**
     *
     * @param string $converter
     * @return Convert
     */
    public function setConverter($converter)
    {
        return $this->setSetting('converter', $converter);
    }
}
