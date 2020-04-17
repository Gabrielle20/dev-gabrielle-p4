<?php

require_once "model/episodeModel.php";
require_once "view/view.php";

/**
 * 
 */
class Episode
{

  public $html;
  public $data;
  public $id = null;



  /**
   * [__construct description]
   * @param Array $uri [description]
   */
  function __construct($arguments)
  {
    $donnees = new EpisodeModel($arguments);
    $this->data = $donnees->data;
    
    $this->html = $this->generatehtml($arguments);
    // $this->data = $this->data->donneesRead;
    // if (!isset($this->data[0])) {
    //   foreach ($this->data as $key => $value) {
    //     $this[$key] = $value;
    //   }
    //   $this->data = null;
    // }
    
  }


  private function generatehtml($arguments){
    if(isset($arguments['list']))
    {
      $view = new View($this->data, "listEpisode");

      return $view->html;
    }

    if (isset($arguments['slug']))
    {
      $view = new View($this->data, "episodeSeul");
      
      return $view->html;
    }

    if (isset($arguments['new']))
    {
      $view = new View($this->data, "newEpisode");

      return $view->html;
    }

    if (isset($arguments['edit']))
    {
      $view = new View($this->data, "edit-episode");

      return $view->html;

    }


    if (isset($arguments['editUnEpisode']))
    {
      $view = new View($this->data, "home");

      return $view->html;
    }

  }



}