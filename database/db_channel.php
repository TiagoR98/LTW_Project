<?php
include_once('../includes/database.php');
include_once('db_user.php');

function addChannel($name,$coverImage,$author) {
  $db = Database::instance()->db();
  $stmt = $db->prepare('INSERT INTO channel (name,coverImage,author) VALUES(?, ?, ?)');
  $stmt->execute(array(htmlspecialchars($name),htmlspecialchars($coverImage),htmlspecialchars($author)));
}


?>
