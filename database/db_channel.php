<?php
include_once('../includes/database.php');
include_once('db_user.php');

function addChannel($name,$author) {
  $db = Database::instance()->db();
  $stmt = $db->prepare('INSERT INTO channel (name,author) VALUES(?, ?)');
  $stmt->execute(array(htmlspecialchars($name),htmlspecialchars($author)));
}


?>
