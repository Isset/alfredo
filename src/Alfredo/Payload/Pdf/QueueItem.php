<?php

namespace Alfredo\Payload\Pdf;

use Alfredo\Payload\PayloadAbstract;

class QueueItem extends PayloadAbstract
{

    public function setIdentifier($identifier)
    {
        $this->setSetting('identifier', $identifier);
    }

    public function setConverter($converter)
    {
        return $this->setSetting('converter', $converter);
    }

}