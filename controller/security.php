<?php

/**
 * 
 */
class Security
{
  
  public $uri;
  public $post;
  private $customRules = [
    "safeString" =>[
        'filter' => FILTER_SANITIZE_STRING,
        'flag'   => FILTER_FLAG_STRIP_LOW
      ]
  ];

  function __construct($argument)
  {
    if (isset($argument["post"])) $this->post = filter_input_array(INPUT_POST, $this->transcode($argument["post"]));
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

  private function transcode($rules){
    $tmp = [];
    foreach ($rules as $key => $value){
      if(isset($this->customRules[$value])) {
        $tmp[$key] = $this->customRules[$value];
      }

      else $tmp[$key] = $value;
    }

    return $tmp;
  }


  public function cryptString($str){

  }

  // $password = $mysqli->escape_string(password_hash(['password'], PASSWORD_BCRYPT));
  // $hash = $mysqli->escape_string(md5(rand(0, 1000)));



}