<?php

require_once 'models/contact.php';

class ContactsRepository
{
	private $connection;
	
	function __construct()
	{
		$url='localhost';
		$dbUsername='root';
		$dbPass='';
		$dbName='phonebook';

		$this->connection= new mysqli($url, $dbUsername, $dbPass, $dbName);
		mysqli_set_charset($this->connection, 'utf-8');
	}

	function getById($id){
		$contacts= $this->getAll();

		foreach ($contacts as $c) {
			if ($c->getId()==$id) {
				return $c;
			}
		}

		return null;
	}

	function getAll(){
		$result= $this->connection->query("SELECT * FROM `contacts` ORDER BY id");

		$contacts = array();
		while ($row= $result->fetch_assoc()){
			$contact= new Contact();
			$contact->setId($row["id"]);
			$contact->setUser_Id($row["user_id"]);
			$contact->setFirst_name($row["first_name"]);
			$contact->setLast_name($row["last_name"]);
			$contact->setPhone_number($row["phone_number"]);
			$contact->setImagePath($row["image_path"]);

			array_push($contacts, $contact);
		}

		return $contacts;
	}

    function getAllByUserId($user_id){
        $result= $this->connection->query("SELECT * FROM `contacts` WHERE user_id=" . $user_id);

        $contacts = array();
        while ($row= $result->fetch_assoc()){
            $contact= new Contact();

            $contact->setId($row["id"]);
            $contact->setUser_Id($row["user_id"]);
            $contact->setFirst_name($row["first_name"]);
            $contact->setLast_name($row["last_name"]);
            $contact->setPhone_number($row["phone_number"]);
			$contact->setImagePath($row["image_path"]);

            array_push($contacts, $contact);
        }

        return $contacts;
    }

	function insert($contact){
		$query= "INSERT INTO `contacts`(`user_id`, `first_name` , `last_name`, `phone_number`, `image_path`) VALUES (?,?,?,?,?)";

		$stmt= $this->connection->prepare($query);
		$stmt->bind_param("issss", $contact->getUser_Id(), $contact->getFirst_name(), $contact->getLast_name(), $contact->getPhone_number(), $contact->getImagePath());

		$stmt->execute();
	}

	function update($contact){
		$query = "UPDATE `contacts` SET user_id=?, first_name=?, last_name=?, phone_number =?, image_path=? WHERE id=?";

		$stmt = $this->connection->prepare($query);
		$stmt -> bind_param("issssi", $contact->getUser_Id(), $contact->getFirst_name(), $contact->getLast_name(), $contact->getPhone_number(),$contact->getImagePath(), $contact->getId());

		$stmt->execute();
	}

	function delete($id){
		$query = "DELETE FROM `contacts` WHERE id=? AND user_id=?";

		$stmt = $this->connection->prepare($query);
		$stmt->bind_param("ii", $id, $_SESSION["LoggedUserId"]);

		$stmt->execute();
	}

	function getLastId() {
		$result= $this->connection->query("SELECT id FROM `contacts` ORDER BY id DESC LIMIT 1");
		return $result->fetch_assoc()['id'];
	}
}