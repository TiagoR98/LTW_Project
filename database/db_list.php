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
  $sql = "UPDATE user SET profilePic= ? WHERE username= ?";
  $stmt = $db->prepare($sql);
  $stmt->execute([$userInfo['profilePic'],$userInfo['username']]);
  return $stmt->fetch();
}

function listStory() {
  $db = Database::instance()->db();
  $stmt = $db->prepare('SELECT *,(SELECT COUNT(*) FROM comment WHERE comment.story == story.ID) AS n_comments FROM story INNER JOIN user ON user.ID == story.author');
  $stmt->execute();
  return $stmt->fetchAll();
}


?>
