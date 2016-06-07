<?php

require_once 'models/user.php';

class UsersRepository
{
	private $connection;
	
	public function __construct()
	{
		$url='localhost';
		$dbUsername='root';
		$dbPass='';
		$dbName='phonebook';

		$this->connection = new mysqli($url, $dbUsername, $dbPass, $dbName);
		mysqli_set_charset($this->connection, 'utf8');
	}

	function getById($id){
		$users = $this->getAll();

		foreach ($users as $u) {
			if ($u->getId()==$id) {
				return $u;
			}
		}

		return null;
	}

	function getByUsernameAndPassword($username, $password){
		$users=$this->getAll();

		foreach ($users as $u) {
			if ($u->getUsername()== $username && $u->getPassword()==$password) {
				return $u;
			}
		}

		return null;
	}

	function getAll(){
		$result =$this->connection->query("SELECT * FROM `users` ORDER BY id");

		$users= array();
		while($row = $result->fetch_assoc()){
			$user= new User();
			$user-> setId($row["id"]);
			$user->setUsername($row["username"]);
			$user->setPassword($row["password"]);
			$user->setIsAdmin($row["is_admin"]);

			array_push($users, $user);
		}

		return $users;
	}

	function insert($user){
		$query = "INSERT INTO `users`(`username`, `password`, `is_admin`) VALUES (?,?,?)";

		$stmt= $this->connection->prepare($query);
		$stmt-> bind_param("ssi", $user->getUsername(), $user->getPassword(), $user->getIsAdmin());

		$stmt-> execute();
	}

	function update($user){
		$query = "UPDATE `users` SET username=?, password=?, is_admin=? WHERE id=?";

		$stmt = $this->connection->prepare($query);
		$stmt -> bind_param("ssii", $user->getUsername(), $user->getPassword(), $user->getIsAdmin(), $user->getId());

		$stmt->execute();
	}

	function delete($id){
		$query = "DELETE FROM `users` WHERE id=?";

		$stmt = $this->connection->prepare($query);
		$stmt->bind_param("i", $id);

		$stmt->execute();
	}
}
