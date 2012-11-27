<?php

namespace Alfredo\Payload\Pdf;

use Alfredo\Payload\PayloadAbstract;

class Convert extends PayloadAbstract
{

    public function __construct()
    {
        $this->setConverter('htmltopdfjava');
    }

    /**
     *
     * @param type $data
     * @param array $options
     * @return ConvertPayload
     */
    public function addHtml($html, array $options = array())
    {
        return $this->addData($html, 'html', $options);
    }

    /**
     *
     * @param type $data
     * @param array $options
     * @return ConvertPayload
     */
    public function addUrl($url, array $options = array())
    {
        return $this->addData($url, 'url', $options);
    }

    /**
     *
     * @param type $data
     * @param array $options
     * @return ConvertPayload
     */
    public function addPdf($data, array $options = array())
    {
        if (empty($options['encoding'])) {
            $options['encoding'] = 'base64';
            $data                = base64_encode($data);
        }
        return $this->addData($data, 'pdf', $options);
    }

    public function setCallBack($url)
    {
        return $this->setSetting('callback', $url);
    }

    public function setConverter($converter)
    {
        return $this->setSetting('converter', $converter);
    }

}