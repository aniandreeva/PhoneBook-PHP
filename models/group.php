<?php

class Group{
    private $id;
    private $userId;
    private $name;

    function __construct(){ }

    public function getId()
    {
        return $this->id;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
}