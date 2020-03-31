<?php 



class Model 
{

	protected $bdd;
  public $data;
  


	public function __construct()
	{
    global $config;
	  $this->bdd = new PDO('mysql:host=localhost;dbname=' .$config["dbname"].';charset=utf8', $config["user"], $config["password"]);
    $this->bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
	}

  protected function query($sql, $all=false)
  {
    $reponse = $this->bdd->query($sql);
      if ($all) $this->data = $reponse->fetchAll();
      else $this->data = $reponse->fetch();

  }
}

