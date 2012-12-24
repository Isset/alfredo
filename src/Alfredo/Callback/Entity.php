<?php

namespace Alfredo\Callback;

class Entity
{

    protected $id;
    protected $identifier;
    protected $send;
    protected $received;
    protected $success;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;
    }

    public function getIdentifier()
    {
        return $this->identifier;
    }

    public function setSend($send)
    {
        if (is_string($send)) {
            $this->send = new \DateTime($send);
        } else {
            $this->send = $send;
        }
    }

    public function getSend($getAsString = true)
    {
        if (!is_object($this->send) || !$getAsString) {
            return $this->send;
        } else {
            return $this->send->format('Y-m-d H:i:s');
        }
    }

    public function setReceived($received)
    {
        if (is_string($received)) {
            $this->received = new \DateTime($received);
        } else {
            $this->received = $received;
        }
    }

    public function getReceived($getAsString = true)
    {
        if (!is_object($this->received) || !$getAsString) {
            return $this->received;
        } else {
            return $this->received->format('Y-m-d H:i:s');
        }
    }

    public function setSuccess($success)
    {
        $this->success = $success;
    }

    public function getSuccess()
    {
        return $this->success;
    }

}