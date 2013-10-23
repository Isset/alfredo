<?php

namespace Alfredo\Payload\Video;

use Alfredo\Payload\PayloadAbstract;

class Convert extends PayloadAbstract
{
    private $counter = 0;

    public function __construct()
    {
        $this->setConverter('ffmpeg');
    }

    public function addVideo($location)
    {
        $video = 'video' . $this->counter++;
        $this->addData($video, 'video');
        $this->setSetting($video, '@' . $location);
    }

    public function getType()
    {
        return 'video';
    }
}