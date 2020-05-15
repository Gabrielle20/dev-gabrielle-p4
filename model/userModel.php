<?php


class UserModel extends Model
{
	function __construct($argument)
	{
		parent::__construct();
		extract($argument);
		if (isset($connect))		return $this->connect();
		if (isset($register))		return $this->createNewAccount();
		if (isset($logout))			return $this->logOut();
	}



	private function connect($pseudo, $password){
		$sql = 
	}



	private function createNewAccount(){
		$sql = "INSERT INTO users (pseudo, password, email, name, prenom) VALUES (:pseudo, :password, :email, :name, :prenom)";
		$request = $this->bdd->prepare($sql);
    	$result = $request->execute([
	      'pseudo'     	=> $data["pseudo"],
	      'password'    => $data["password"],
	      'email'   	=> $data["email"],
	      'name'		=> $data["name"],
	      'prenom'		=> $data["prenom"]
   		]);
	}

}

