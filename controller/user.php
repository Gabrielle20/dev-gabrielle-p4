<?php

require_once "./model/userModel.php";
require_once "./controller/SessionManager.php";

Class User{

	public $name = "Jean Forteroche";
	public $id = null;
	private $pseudo;
	private $email;
	private $prenom;
	public $data;
	public $html;
	public $session;



	function __construct()
  	{
  		//1.  on vérifie les informations en session
  		$this->session = new SessionManager();
  		if(empty($this->session->name)) $this->authByPostData();
  		else $this->authBySession();

  		//2. on vérifie les infos en post



	    // $donnees = new UserModel($arguments);
	    // $this->data = $donnees->data;
	    
	    // $this->html = $this->generatehtml($arguments);
	}


	private function authByPostData(){
		global $safeData;
		if ($safeData->post === null) return $this->session->end();
		if ($safeData->post["pseudo"] === null || $safeData->post["password"] === null) return $this->session->end();
		$data = new UserModel(["connect" => [
			"pseudo" => $safeData->post["pseudo"],
			"pwd" => $safeData->post["password"],
		]]);
		$this->hydrate($data->data);
	}


	private function authBySession(){
		if(isset($this->session->pseudo)) return;
		$this->pseudo =$this->session->pseudo;
		$this->email = $this->session->email;
		$this->name = $this->session->name;
		$this->prenom = $this->session->prenom;

		// die(var_dump($this));
	}


	private function hydrate($data){
		if(!$data) return;
		foreach ($data as $key => $value){
			$this->$key = $value;
			$this->session->update($key, $value);
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