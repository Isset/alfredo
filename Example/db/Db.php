<?php

class Db Extends \Alfredo\Callback\DatabaseAbstract
{

    private $pdo;
    private $table = 'alfredo_callback';

    public function __construct($dsn, $username, $password)
    {
        $this->pdo = new PDO($dsn, $username, $password);
    }

    public function get($identifier)
    {
        $prepared = $this->pdo->prepare('SELECT * FROM ' . $this->table . ' WHERE identifier = :identifier');
        $prepared->execute(array(':identifier' => $identifier));
        $data         = $prepared->fetch(PDO::FETCH_ASSOC);
        if (!empty($data)) {
            return $this->arrayToEntity($data);
        } else {
            return false;
        }
    }

    public function save(\Alfredo\Callback\Entity $entity)
    {
        $id = $entity->getId();
        if (empty($id)) {
            $data = array(
                ':identifier' => $entity->getIdentifier(),
                ':send' => $entity->getSend(),
            );
            $prepared     = $this->pdo->prepare('INSERT INTO ' . $this->table . ' ( identifier, send) VALUES ( :identifier, :send)');
            $prepared->execute(
                    $data
            );
            $entity->setId($this->pdo->lastInsertId());
        } else {
            $data = array(
                ':identifier' => $entity->getIdentifier(),
                ':send' => $entity->getSend(),
                ':received' => $entity->getReceived(),
                ':success' => $entity->getSuccess(),
                ':id' => $id
            );
            $prepared     = $this->pdo->prepare('UPDATE ' . $this->table . ' SET identifier=:identifier, send=:send,  received=:received, success=:success WHERE id=:id');
            $prepared->execute(
                    $data
            );
        }
    }

}