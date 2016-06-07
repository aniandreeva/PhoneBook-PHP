<?php

require_once 'models/contact.php';
require_once 'models/group.php';

class ContactsGroupsRepository
{
    private $connection;

    function __construct(){
        $url='localhost';
        $dbUsername='root';
        $dbPass='';
        $dbName='phonebook';

        $this->connection= new mysqli($url, $dbUsername, $dbPass, $dbName);
        mysqli_set_charset($this->connection, 'utf-8');
    }

    function getGroupsByContactId($contactId){
        $result= $this->connection->query("SELECT * FROM groups WHERE userId=" . $_SESSION["LoggedUserId"] . " AND id IN (SELECT DISTINCT groupId FROM `contacts_groups` cg WHERE cg.contactId=" . $contactId . ")");

        $groups = array();
        while ($row= $result->fetch_assoc()){
            $group= new Group();

            $group->setId($row["id"]);
            $group->setUserId($row["userId"]);
            $group->setName($row["name"]);

            array_push($groups, $group);
        }

        return $groups;
    }

    function getContactsByGroupId($groupId){
        $result= $this->connection->query("SELECT * FROM `contacts_groups` WHERE groupId=" . $groupId);

        $contacts = array();
        while ($row= $result->fetch_assoc()){
            $contact= new Contact();

            $contact->setId($row["id"]);
            $contact->setUser_Id($row["userId"]);
            $contact->setFirst_name($row["first_name"]);

            array_push($contacts, $contact);
        }

        return $contacts;
    }

    function getNotGroupsByContactId($contactId){
        $result= $this->connection->query("SELECT * FROM groups WHERE userId=" . $_SESSION["LoggedUserId"] . " AND id NOT IN (SELECT DISTINCT groupId FROM `contacts_groups` cg WHERE cg.contactId=" . $contactId . ")");

        $groups = array();
        while ($row= $result->fetch_assoc()){
            $group= new Group();

            $group->setId($row["id"]);
            $group->setUserId($row["userId"]);
            $group->setName($row["name"]);

            array_push($groups, $group);
        }

        return $groups;
    }

    function insert($groupId, $contactId){
        $query="INSERT INTO `contacts_groups`(`groupId`, `contactId`) VALUES (?,?) ";

        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("ii", $groupId, $contactId);

        $stmt->execute();
    }
    
//    function update($groupId, $contactId){
//        $query="UPDATE `contacts_groups` SET `groupId`=? WHERE `contactId`=?";
//
//        $stmt = $this->connection->prepare($query);
//        $stmt->bind_param("ii", $groupId, $contactId);
//
//        $stmt->execute();
//    }

    function removeGroupsByContactId($contactId){
        $query="DELETE FROM `contacts_groups` WHERE `contactId`=?";

        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("i", $contactId);

        $stmt->execute();
    }
}