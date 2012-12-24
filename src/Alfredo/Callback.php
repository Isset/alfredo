<?php

namespace Alfredo;

class Callback
{

    private $db;

    public function __construct(Callback\DatabaseInterface $db)
    {
        $this->db = $db;
    }

    public function add($identifier)
    {
        $entity = new Callback\Entity();
        $entity->setIdentifier($identifier);
        $entity->setSend(new \DateTime);
        $this->db->save($entity);
    }

    public function handle(Callback\CallableInterface $interface, array $data, $echo = true)
    {
        if (empty($data['identifier']) || empty($data['status'])) {
            return false;
        }
        $entity = $this->db->get($data['identifier']);

        $entity->setReceived(new \DateTime);
        $entity->setSuccess($data['status'] == 'success');
        $this->db->save($entity);
        $interface->callback($entity);
        if ($echo) {
            echo '[success]';
        }
    }

}
