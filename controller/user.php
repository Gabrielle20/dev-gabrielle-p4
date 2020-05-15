<?php

Class User{

	public $name = "Jean Forteroche";
	public $id;
	private $pseudo;
	private $password;
	private $email;
	public $data;
	public $html;


	function __construct($arguments)
  	{
	    $donnees = new UserModel($arguments);
	    $this->data = $donnees->data;
	    
	    $this->html = $this->generatehtml($arguments);
	}


	private function generatehtml($arguments){
		if (isset($arguments['connect'])){
			$view = new View($this->data, "authentification");

			return $view->html;
		}

		if (isset($arguments['register'])){
			$view = new View($this->data, "nouveau-compte");

			return $view->html;
		}
	}


	// public function connect($pseudo, $password)
	// {

	// }


	// public function logOut()
	// {

	// }


	// // if(isset($_POST['login'])){
	// // 	file_get_contents("./template/authentification.html");
	// // }

	// // elseif(isset($_POST['register'])){
	// // 	file_get_contents("./template/nouveau-compte.html");
	// }
}