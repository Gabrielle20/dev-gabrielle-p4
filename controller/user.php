<?php

require_once "./model/userModel.php";

Class User{

	public $name = "Jean Forteroche";
	public $id = null;
	private $pseudo;
	private $email;
	private $prenom;
	public $data;
	public $html;



	function __construct()
  	{
  		//1.  on vérifie les informations en session
  		if(empty($_SESSION)) $this->authByPostData();
  		else $this->authByPostSession();

  		//2. on vérifie les infos en post



	    // $donnees = new UserModel($arguments);
	    // $this->data = $donnees->data;
	    
	    // $this->html = $this->generatehtml($arguments);
	}


	private function authByPostData(){
		global $safeData;
		if ($safeData->post === null) return;
		if ($safeData->post["pseudo"] === null || $safeData->post["password"] === null) return;
		$data = new UserModel(["connect" => [
			"pseudo" => $safeData->post["pseudo"],
			"pwd" => $safeData->post["password"],
		]]);
		$this->hydrate($data);
	}


	private function authByPostSession(){
		$_SESSION['pseudo'] = "{{ pseudo }}";
		$_SESSION['password'] = "{{ password }}";

		if (!isset($_SESSION['pseudo'], $_SESSION['password'])){
			echo "Votre identifiant ou mot de passe sont incorrects";
		}

	}


	private function hydrate($data){
		if(!$data) return;
		foreach ($data as $key => $value){
			$this->$key = $value;
		}
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