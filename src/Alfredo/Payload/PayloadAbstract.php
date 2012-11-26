<?php

namespace Alfredo\Payload;

abstract class PayloadAbstract
{

    protected $payload = array();

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

}
