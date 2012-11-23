<?php

namespace Alfredo\Payload;

class QueuePayload extends PayloadAbstract
{

    public function setIdentifier($identifier)
    {
        $this->addSetting('identifier', $identifier);
    }

}