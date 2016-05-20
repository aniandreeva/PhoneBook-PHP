<?php

class User
{
	private $id;
	private $username;
	private $password;
	private $is_admin;
	
	function __construct(){}

	public function getId(){
		return $this->id;
	}

	public function getUsername(){
		return $this->username;
	}

	public function getPassword(){
		return $this->password;
	}

	public function getIsAdmin()
	{
		return $this->is_admin;
	}

	public function setId($id){
		$this->id=$id;
	}

	public function setUsername($username){
		$this->username=$username;
	}

	public function setPassword($password){
		$this->password=$password;
	}

	public function setIsAdmin($is_admin)
	{
		$this->is_admin = $is_admin;
	}
}