<?php

require_once "model.php";

Class commentModel extends Model{

	function __construct($argument){
		parent::__construct();
		extract($argument);
		if (isset($lastComments)) return $this->getLastComments();
		if (isset($episode_id))	  return $this->getComment($episode_id);
		if (isset($editComment))  return $this->getCommentForEdit();
		if (isset($postComment))  return $this->postComment();
	}



	private function getLastComments(){
		$sql = "SELECT episodes.title AS '{{ episode_title }}', comments.author AS '{{ author }}', comments.date_time AS '{{ date }}', comments.content AS '{{ comment }}' FROM `comments` INNER JOIN episodes WHERE comments.episode_id = episodes.id ORDER BY comments.date_time DESC LIMIT 5";
		$this->query($sql, true);
	}


	private function getComment($episode_id){
		$sql = "SELECT author AS '{{ author }}', date_time AS '{{ date }}', content AS '{{ comment }}' FROM `comments` WHERE `episode_id` = '$episode_id' ORDER BY date_time DESC ";
		$this->query($sql, true);
	}


	private function getCommentForEdit(){
		$sql = "SELECT id AS '{{ id }}', author AS '{{ author }}', content AS '{{ content }}', date_time AS '{{ date }}', episode_id AS '{{ episode_id }}', etat AS '{{ state }}' FROM comments";
		$this->query($sql, true);
	}


	private function postComment(){
		$sql = "INSERT INTO comments (title, author, date_time, content) VALUES (:title, :author, NOW(), :content)";
		$request = $this->bdd->prepare($sql);
    	$result = $request->execute([
	      'content'   	=>$data["content"],
	      'id'        	=> $data["id"],
	      'episode_id'	=> $data["episode_id"],
	      'author'    	=> $data["author"]
    	]);
	}
}