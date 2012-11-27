<?php

namespace Alfredo\Payload;

class Login extends PayloadAbstract
{

    private $consumerKey;
    private $privateKey;

    public function __construct($consumerKey, $privateKey)
    {
        $this->consumerKey = $consumerKey;
        $this->privateKey  = $privateKey;
    }

    public function getPayload()
    {
        $time = time();
        $this->setSetting('consumer_key', $this->consumerKey);
        $this->setSetting('time', $time);
        $this->setSetting('hash', crypt($time . '' . $this->privateKey . '' . $this->consumerKey, '$2a$07$' . $this->consumerKey . '$'));



        

        return parent::getPayload();
    }

}
