<?php

namespace Alfredo\Callback;

abstract class DatabaseAbstract implements DatabaseInterface
{

    protected function arrayToEntity(array $array)
    {

        $entity = new Entity();
        $entity->setId($array['id']);
        $entity->setIdentifier($array['identifier']);
        $entity->setReceived($array['received']);
        $entity->setSend($array['send']);
        $entity->setSuccess($array['success']);
        return $entity;
    }

}