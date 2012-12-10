<?php

namespace Alfredo\Payload\Video;

use Alfredo\Payload\PayloadAbstract;

class QueueItem extends PayloadAbstract
{

    public function setIdentifier($identifier)
    {
        $this->setSetting('identifier', $identifier);
    }


    public function getType()
    {
        return 'video';
    }

}