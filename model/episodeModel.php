<?php

require_once "model/model.php";

/**
 * 
 */
class EpisodeModel extends Model
{
  
  function __construct($argument)
  {
    parent::__construct();
    extract($argument);
    if (isset($list))             return $this->getEpisodeList();
    if (isset($argument["slug"])) return $this->getDataFromSlug($argument["slug"]);
    //if (isset($last))             return $this->getLastEpisodes();
  }


  private function getDataFromSlug($slug){
    $sql = "SELECT * FROM `episodes` WHERE `slug` = '$slug'";
    $this->query($sql);
  }


  private function getEpisodeList(){
    $sql = "SELECT title AS '{{ title }}', content AS '{{ content }}' FROM `episodes` ORDER BY id DESC";
    $this->query($sql, true);
  }


//AJOUTE PAR MOI: Mardi 21/01/2020
  
  private function getLastEpisodes(){
    $sql = "SELECT title AS '{{ title }}', content AS '{{ content }}' FROM `episodes` ORDER BY date DESC";
    $this->query($sql, true);
  }

}