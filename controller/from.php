<?php


Class Form{
	
	public $html;
	public $data;


	function __construct()
	{
		$donnees = new formModel($arguments);
		$this->data = $donnes->data;

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
}