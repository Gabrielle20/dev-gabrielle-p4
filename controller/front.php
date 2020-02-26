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
    switch($uri[0]){
      case "episode" : $this->afficheEpisode($uri[1]); break;
      case "contact" : $this->contact(); break;
      default        : $this->afficheAccueil(); break;
    }
    
    
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
  


  private function contact(){
    $this->content = "jhlzdl";
    $this->title = "Contact";
  }



}


