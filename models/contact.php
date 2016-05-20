<?php

class Contact
{
	private $id;
	private $user_id;
	private $first_name;
	private $last_name;
	private $phone_number;
	private $image_path;
	
	function __construct(){}

	public function getId(){
		return $this->id;
	}

	public function getUser_Id(){
		return $this->user_id;
	}

	public function getFirst_name(){
		return $this->first_name;
	}

	public function getLast_name(){
		return $this->last_name;
	}

	public function getPhone_number(){
		return $this->phone_number;
	}

	public function getImagePath(){
		return $this->image_path;
	}

	public function setId($id){
		$this->id=$id;
	}

	public function setUser_Id($user_id){
		$this->user_id=$user_id;
	}

	public function setFirst_name($first_name){
		$this->first_name=$first_name;
	}

	public function setLast_name($last_name){
		$this->last_name=$last_name;
	}

	public function setPhone_number($phone_number){
		$this->phone_number=$phone_number;
	}

	public function setImagePath($img_path){
		$this->image_path=$img_path;
	}
}
