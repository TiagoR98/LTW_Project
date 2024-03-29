<?php
include_once('../includes/database.php');
include_once('db_user.php');

function getStory($id) {
  $db = Database::instance()->db();
  $stmt = $db->prepare('SELECT *,(SELECT COUNT(*) FROM comment WHERE comment.story == storyID) AS n_comments,channel.name AS channelName,story.author AS storyAuthor FROM story INNER JOIN user ON user.ID == story.author INNER JOIN channel ON channel.ID == story.channel  WHERE storyID == ?');
  $stmt->execute(array($id));
  return $stmt->fetch();
}

function addStory($title,$content,$author,$date,$channel,$image) {
  $db = Database::instance()->db();
  $stmt = $db->prepare('INSERT INTO story (title,content,author,date,channel,image) VALUES(?, ?, ?, ?, ?, ?)');
  $stmt->execute(array(htmlspecialchars($title),htmlspecialchars($content),htmlspecialchars($author),htmlspecialchars($date),htmlspecialchars($channel),htmlspecialchars($image)));
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

function addComment($content,$date,$story,$author,$image) {
  $db = Database::instance()->db();
  $stmt = $db->prepare('INSERT INTO comment (content,date,story,author,image) VALUES(?, ?, ?, ?, ?)');
  $stmt->execute(array(htmlspecialchars($content),htmlspecialchars($date),htmlspecialchars($story),htmlspecialchars($author),htmlspecialchars($image)));
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

function deleteStory($storyId){
  $db = Database::instance()->db();
  $stmt = $db->prepare('DELETE FROM story WHERE storyID = ?');
  $stmt->execute(array($storyId));
}
 ?>
