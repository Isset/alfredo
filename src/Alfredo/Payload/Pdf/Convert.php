<?php

namespace Alfredo\Payload\Pdf;

use Alfredo\Payload\PayloadAbstract;

class Convert extends PayloadAbstract
{
    public function __construct()
    {
        $this->setConverter('htmltopdfjava');
        $this->setSetting('packer', 'pdftk');
    }

    /**
     *
     * @param type $data
     * @param array $options
     * @return Convert
     */
    public function addHtml($html, array $options = array())
    {
        if (!isset($options['htmlentities'])) {
            $options['htmlentities'] = true;
        }
        return $this->addData($html, 'html', $options);
    }

    /**
     *
     * @param type $data
     * @param array $options
     * @return Convert
     */
    public function addUrl($url, array $options = array())
    {
        return $this->addData($url, 'url', $options);
    }

    /**
     *
     * @param type $data
     * @param array $options
     * @return Convert
     */
    public function addPdf($data, array $options = array())
    {
        if (empty($options['encoding'])) {
            $options['encoding'] = 'base64';
            $data                = base64_encode($data);
        }
        if (empty($options['converter'])) {
            $options['converter'] = false;
        }
        return $this->addData($data, 'pdf', $options);
    }

    public function getType()
    {
        return 'pdf';
    }
}