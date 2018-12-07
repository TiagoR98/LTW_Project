<?php
include_once('../includes/database.php');
include_once('db_user.php');

function getStory($id) {
  $db = Database::instance()->db();
  $stmt = $db->prepare('SELECT *,(SELECT COUNT(*) FROM comment WHERE comment.story == storyID) AS n_comments FROM story INNER JOIN user ON user.ID == story.author WHERE storyID == ?');
  $stmt->execute(array($id));
  return $stmt->fetch();
}

function addStory($title,$content,$author,$date,$channel) {
  $db = Database::instance()->db();
  $stmt = $db->prepare('INSERT INTO story (title,content,author,date,channel) VALUES(?, ?, ?, ?, ?)');
  $stmt->execute(array(htmlspecialchars($title),htmlspecialchars($content),htmlspecialchars($author),htmlspecialchars($date),htmlspecialchars($channel)));
}

function addStoryVote($storyId,$username,$type){
  $userID = getIdFromUsername($username);
  $typeID = getVoteTypeID($type);


  //delete existing votes
  $db = Database::instance()->db();
  $stmt = $db->prepare('DELETE FROM vote_story WHERE user = ? AND story = ?');
  $stmt->execute(array($userID,$storyId));

  //add new vote
  $stmt = $db->prepare('INSERT INTO vote_story VALUES(?, ?, ?)');
  $stmt->execute(array($userID,$storyId,$typeID));
}

function getVoteTypeID($type){
  $db = Database::instance()->db();
  $stmt = $db->prepare("SELECT ID from vote_type WHERE type LIKE ?");
  $stmt->execute(array("%$type%"));
  return $stmt->fetch()['ID'];
}

function addComment($content,$date,$story,$author) {
  $db = Database::instance()->db();
  $stmt = $db->prepare('INSERT INTO comment (content,date,story,author) VALUES(?, ?, ?, ?)');
  $stmt->execute(array(htmlspecialchars($content),htmlspecialchars($date),htmlspecialchars($story),htmlspecialchars($author)));
}

function addCommentVote($commentId,$username,$type){
  $userID = getIdFromUsername($username);
  $typeID = getVoteTypeID($type);


  //delete existing votes
  $db = Database::instance()->db();
  $stmt = $db->prepare('DELETE FROM vote_comment WHERE user = ? AND comment = ?');
  $stmt->execute(array($userID,$commentId));

  //add new vote
  $stmt = $db->prepare('INSERT INTO vote_comment VALUES(?, ?, ?)');
  $stmt->execute(array($userID,$commentId,$typeID));
}
 ?>
