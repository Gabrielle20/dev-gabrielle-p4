<?php


Class Form{
	
	public $html;
	public $data;
	public $firstName;
	public $lastName;
	public $country;
	public $email;
	public $subject;
	public $message;
	private $mailTo = "gabriellepedro@charisma.fr";


	function __construct()
	{
		$donnees = new formModel($arguments);
		$this->data = $donnes->data;
		if (! empty($this->data)) $this->mailSending();

		$this->html = $this->generatehtml($arguments);
	}



	private function generatehtml($arguments)
	{
		if (isset($arguments['contact']))
		{
			$view = new View($this->data, "form");

			return $view->html;
		}
	}


	private function mailSending(){
		if (! isset($this->data->post)) echo "Vous n'avez pas rempli le formulaire.";
		$this->lastName = $this->data->lastName;
		$this->firstName = $this->data->firstName;
		$this->country = $this->data->country;
		$this->email = $this->data->email;
		$this->subject = $this->data->subject;
		$this->message = $this->data->message;

		$headers = "From : " . $this->data->email;
		$txt = "Vous avez reçu un email de " . $this->data->lastName . $this->data->firstName . ".\n\n" . $this->data->message;

		die(var_dump($this->data));

		mail($mailTo, $this->data->message, $txt, $headers);
		// header("Location : ")

	}
}