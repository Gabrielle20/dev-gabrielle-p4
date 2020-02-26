<?php
error_reporting(E_ALL | E_STRICT);
  ini_set('display_errors',1);

  
require_once "controller/front.php";
require_once "controller/security.php";



$config = [
	"dbname" => "blog_forteroche",
	"user"     => "root",
  "password" => "mysql",
  "path"     => "OpenClassrooms/Projet_3/Projet/view/", //changer par le sous dossier où est rangé votre projet
  "debug"    => true,
];


if ($config["debug"]){
  error_reporting(E_ALL | E_STRICT);
  ini_set('display_errors',1);
}



$safeData = new Security(
  [
    "post" =>[],
    "uri" => $config["path"]
  ]
);


switch ($safeData->uri[0]) {
  case 'admin':
    $page = new Back($safeData->uri);
    break;
  
  default:
    $page = new Front($safeData->uri);
    break;
}


echo $page->html;


// /chapitre/nom-du-chapitre
// [
//   chapitre,
//   nom-du-chapitre
// ]

// /admin/edit-chapitre/5
// [
//   admin,
//   edit-chapitre,
//   5
// ]

// /liste-chapitres
// [
//   liste-chapitres
// ]