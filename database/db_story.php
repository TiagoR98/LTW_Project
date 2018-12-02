<?php
include_once('../includes/database.php');

function getStory($id) {
  $db = Database::instance()->db();
  $stmt = $db->prepare('SELECT *,(SELECT COUNT(*) FROM comment WHERE comment.story == storyID) AS n_comments FROM story INNER JOIN user ON user.ID == story.author WHERE storyID == $id');
  $stmt->execute(array($id));
  return $stmt->fetch();
}

function addStory($title,$content,$author,$date,$channel) {
  $db = Database::instance()->db();
  $stmt = $db->prepare('INSERT INTO story (title,content,author,date,channel) VALUES(?, ?, ?, ?, ?)');
  $stmt->execute(array($title,$content,$author,$date,$channel));
}

function addComment($content,$date,$story,$author) {
  $db = Database::instance()->db();
  $stmt = $db->prepare('INSERT INTO comment (content,date,story,author) VALUES(?, ?, ?, ?)');
  $stmt->execute(array($content,$date,$story,$author));
}

 ?>
