<?php

require_once "model.php";

Class commentModel extends Model{

	function __construct($argument){
		parent::__construct();
		extract($argument);
		if (isset($lastComments)) return $this->getLastComments();
		if (isset($episode_id))	  return $this->getComment();
		if (isset($editComment))  return $this->getCommentForEdit();
	}


	private function getLastComments(){
		$sql = "SELECT episodes.title AS '{{ episode_title }}', comments.author AS '{{ author }}', comments.date_time AS '{{ date }}', comments.content AS '{{ comment }}' FROM `comments` INNER JOIN episodes WHERE comments.episode_id = episodes.id ORDER BY comments.date_time DESC LIMIT 5";
		$this->query($sql, true);
	}


	private function getComment($episode_id){
		$sql = "SELECT episode_id AS '{{ episode_id }}', author AS '{{ author }}', date_time AS '{{ date }}', content AS '{{ comment }}' ORDER BY date_time DESC LIMIT 5";
		$this->query($sql);
	}


	private function getCommentForEdit(){
		$sql = "SELECT id AS '{{ id }}', author AS '{{ author }}', content AS '{{ content }}', date_time AS '{{ date }}', episode_id AS '{{ episode_id }}', etat AS '{{ state }}' FROM comments";
		$this->query($sql, true);
	}
}