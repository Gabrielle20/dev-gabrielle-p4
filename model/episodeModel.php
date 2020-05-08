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
    if (isset($save))             return $this->addNewEpisode($save);
    if (isset($list))             return $this->getEpisodeList();
    if (isset($slug))             return $this->getDataFromSlug($slug);
    if (isset($edit))             return $this->getEpisodeListToEdit();
    if (isset($editUnEpisode))    return $this->editUnEpisode($editUnEpisode);
    if (isset($delete))           return $this->deleteEpisode($id);
  }


  private function getDataFromSlug($slug){
    $sql = "SELECT id, id AS '{{ id }}', title AS '{{ title }}', title, content AS '{{ content }}' FROM `episodes` WHERE `slug` = '$slug'";
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
    $sql = "SELECT id AS '{{ id }}', title AS '{{ title }}', date_time AS '{{ date }}', slug AS '{{ episode_slug }}' FROM `episodes`";
    $this->query($sql, true);
  }


  private function editUnEpisode($data){
    if($data === true) return;
    $sql = "UPDATE episodes SET content = :content WHERE id = :id";
    $request = $this->bdd->prepare($sql);
    // die(var_dump($data));
    $result = $request->execute($data, $request);

  }


  private function deleteEpisode($id){
    $sql = "DELETE FROM episodes WHERE id = {{ id }}";
    $request = $this->bdd->prepare($sql);
    $result = $request->execute($data, $request);
  }

  
}

