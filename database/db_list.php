<?php
include_once('../includes/database.php');

function listProfile($username) {
  $db = Database::instance()->db();
  $stmt = $db->prepare('SELECT * FROM user WHERE username = ?');
  $stmt->execute(array($username));
  return $stmt->fetch();
}

function updateProfile($userInfo) {
  $db = Database::instance()->db();
  $sql = "UPDATE user SET profilePic= ?,email=?,birth = ? WHERE username= ?";
  $stmt = $db->prepare($sql);
  $stmt->execute([$userInfo['profilePic'],$userInfo['email'],$userInfo['birth'],$userInfo['username']]);
  return $stmt->fetch();
}

function listStory() {
  $db = Database::instance()->db();
  $stmt = $db->prepare('SELECT *,(SELECT COUNT(*) FROM comment WHERE comment.story == storyID) AS n_comments FROM story INNER JOIN user ON user.ID == story.author ORDER BY storyID DESC');
  $stmt->execute();
  return $stmt->fetchAll();
}

function getStoriesByUser($username) {
  $db = Database::instance()->db();
  $stmt = $db->prepare('SELECT *,(SELECT COUNT(*) FROM comment WHERE comment.story == storyID) AS n_comments FROM story INNER JOIN user ON user.ID == story.author WHERE user.username = ? ORDER BY storyID DESC');
  $stmt->execute(array($username));
  return $stmt->fetchAll();
}

function getStoriesByChannel($channelID) {
  $db = Database::instance()->db();
  $stmt = $db->prepare('SELECT *,(SELECT COUNT(*) FROM comment WHERE comment.story == storyID) AS n_comments FROM story INNER JOIN user ON user.ID == story.author WHERE story.channel == ?');
  $stmt->execute(array($channelID));
  return $stmt->fetchAll();
}

function getCommentsByStory($storyID) {
  $db = Database::instance()->db();
  $stmt = $db->prepare('SELECT * FROM comment INNER JOIN user ON author == user.ID WHERE comment.story = ? ORDER BY ID DESC');
  $stmt->execute(array($storyID));
  return $stmt->fetchAll();
}

function listChannel() {
  $db = Database::instance()->db();
  $stmt = $db->prepare('SELECT * FROM channel');
  $stmt->execute();
  return $stmt->fetchAll();
}

?>
