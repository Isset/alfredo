<?php

namespace Alfredo\Payload;

class ConvertPayload extends PayloadAbstract
{

    public function addHtml($html, array $options = array())
    {
        return $this->addPayload($html, 'html', $options);
    }

    public function addUrl($url, array $options = array())
    {
        return $this->addPayload($url, 'url', $options);
    }

    public function addCallBack($url)
    {
        return $this->addSetting('callback', $url);
    }

}