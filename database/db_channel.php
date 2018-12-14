<?php
include_once('../includes/database.php');
include_once('db_user.php');

function getChannel($id){
  $db = Database::instance()->db();
  $stmt = $db->prepare('SELECT * FROM channel WHERE ID=?');
  $stmt->execute(array($id));
  return $stmt->fetch();
}

function addChannel($name,$coverImage,$author) {
  $db = Database::instance()->db();
  $stmt = $db->prepare('INSERT INTO channel (name,coverImage,author) VALUES(?, ?, ?)');
  $stmt->execute(array(htmlspecialchars($name),htmlspecialchars($coverImage),htmlspecialchars($author)));
}

function deleteChannel($channelId){
  $db = Database::instance()->db();
  $stmt = $db->prepare('DELETE FROM channel WHERE ID = ?');
  $stmt->execute(array($channelId));
}

function updateChannel($channelInfo) {
  $db = Database::instance()->db();
  $sql = "UPDATE channel SET coverImage= ?,name=? WHERE ID= ?";
  $stmt = $db->prepare($sql);
  $stmt->execute([$channelInfo['coverImage'],htmlspecialchars($channelInfo['name']),$channelInfo['ID']]);
  return $stmt->fetch();
}

?>
