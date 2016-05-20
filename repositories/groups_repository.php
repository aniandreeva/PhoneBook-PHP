<?php

require_once 'models/group.php';

class GroupsRepository
{
    private $connection;

    function __construct()
    {
        $url = 'localhost';
        $dbUsername = 'root';
        $dbPass = '';
        $dbName = 'phonebook';

        $this->connection = new mysqli($url, $dbUsername, $dbPass, $dbName);
        mysqli_set_charset($this->connection, 'utf-8');
    }

    function getById($id)
    {
        $groups = $this->getAll();

        foreach ($groups as $g) {
            if ($g->getId() == $id) {
                return $g;
            }
        }

        return null;
    }

    function getAll()
    {
        $result = $this->connection->query("SELECT * FROM `groups` ORDER BY id");

        $groups = array();
        while ($row = $result->fetch_assoc()) {
            $group = new Group();
            $group->setId($row["id"]);
            $group->setUserId($row["userId"]);
            $group->setName($row["name"]);


            array_push($groups, $group);
        }

        return $groups;
    }

    function getAllByUserId($userId)
    {
        $groups = $this->getAll();
        $gr = array();

        foreach ($groups as $g) {
            if ($g->getUserId() == $userId) {
                array_push($gr, $g);
            }
        }
        return $gr;
    }

    function insert($group)
    {
        $query = "INSERT INTO `groups`(`name`, `userId`) VALUES (?,?)";

        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("si", $group->getName(), $group->getUserId($_SESSION["LoggedUserId"]));

        $stmt->execute();
    }

    function update($group)
    {
        $query = "UPDATE `groups` SET name=?, userId=? WHERE id=?";

        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("sii", $group->getName(), $group->getUserId($_SESSION["LoggedUserId"]), $group->getId());

        $stmt->execute();
    }

    function delete($id)
    {
        $query = "DELETE FROM `groups` WHERE id=? AND userId=?";

        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("ii", $id, $_SESSION["LoggedUserId"]);

        $stmt->execute();
    }
}