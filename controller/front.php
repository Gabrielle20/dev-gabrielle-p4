<?php

require_once "controller/episode.php";
require_once "controller/comment.php";
require_once "controller/menu.php";

/**
 * 
 */
class Front
{

  public $html;

  /**
   * [__construct description]
   * @param Array $uri [description]
   */
  function __construct($uri)
  {
    if ($uri[0] === "")         $this->afficheAccueil();
    if ($uri[0] === "episode") $this->afficheEpisode($uri[1]);
    
    
    $menu = new Menu("getAllPageWithoutChapterTitle");
    $view = new View(
      [
        "{{ title }}" =>$this->title,
        "{{ menu }}" =>$menu->html,
        "{{ content }}" =>$this->content

      ],

      "main"
    );

    $this->html .= $view->html;

  }




  private function afficheEpisode($slug){

    $monEpisode = new Episode(["slug"=>$slug]);
    $this->html = $monEpisode->title;

  }




  private function afficheAccueil(){
    $episodes = new Episode(["list"=>true]);
    $lastComments = new Comment(["lastComments" =>true]);
    
    $view = new View(
      [
        "{{ episodes }}" => $episodes->html,
        "{{ commentaires }}" => $lastComments->html
      ],
      "home"
    );

    $this->content = $view->html;
    $this->title = "Un Billet pour l'Alaska";
  }
  




}


