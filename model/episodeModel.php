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
    if (isset($save))              return $this->addNewEpisode($save);
    if (isset($list))             return $this->getEpisodeList();
    if (isset($argument["slug"])) return $this->getDataFromSlug($argument["slug"]);
    if (isset($edit))             return $this->getEpisodeListToEdit();
  }


  private function getDataFromSlug($slug){
    $sql = "SELECT * FROM `episodes` WHERE `slug` = '$slug'";
    $this->query($sql);
  }


  private function getEpisodeList(){
    $sql = "SELECT title AS '{{ title }}', content AS '{{ content }}' FROM `episodes` ORDER BY id DESC";
    $this->query($sql, true);
  }


  private function addNewEpisode($data){
    $sql = "INSERT INTO episodes (title, slug, author, date_time, content) VALUES (:title, :slug, :author, NOW(), :content)";

    $request = $this->bdd->prepare($sql);
    $result = $request->execute($data);

  }


  private function getEpisodeListToEdit(){
    $sql = "SELECT id AS '{{ id }}', title AS '{{ title }}', date_time AS '{{ date }}' FROM `episodes`";
    $this->query($sql, true);
  }

  
}

