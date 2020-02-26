<?php

/**
 * 
 */
class Security
{
  
  public $uri;

  function __construct($argument)
  {
    if (isset($argument["uri"])) $this->sanityzeUrl($argument["uri"]);
  }


  private function sanityzeUrl($path){
    $this->uri = filter_input(INPUT_SERVER, "REQUEST_URI", FILTER_SANITIZE_URL);

    if ($path !== ""){
      $this->uri = explode($path, $this->uri);
      $this->uri = implode("", $this->uri);
    }
    $this->uri = explode("/", $this->uri);
    $this->uri = array_slice($this->uri, 1);
  }

}