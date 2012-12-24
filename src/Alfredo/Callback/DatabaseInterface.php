<?php

namespace Alfredo\Callback;

interface DatabaseInterface
{

    public function save(Entity $entity);
    /**
     *
     * @param \Alfredo\Callback\Entity $identifier
     */
    public function get($identifier);

}