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
  $stmt->execute([htmlspecialchars($userInfo['profilePic']),htmlspecialchars($userInfo['email']),htmlspecialchars($userInfo['birth']),htmlspecialchars($userInfo['username'])]);
  return $stmt->fetch();
}

function listStory($sort='',$offset = 0,$limit = 5) {
  switch($sort){
    case 'mRecent':
      $order = 'storyID DESC';
      break;
    case 'mOld':
      $order = 'storyID ASC';
      break;
    case 'mUpVoted':
      $order = 'upvotes DESC';
      break;
    case 'mDownVoted':
      $order = 'downvotes DESC';
      break;
    case 'mComments':
      $order = 'n_comments DESC';
      break;
    default:
      $order = 'storyID DESC';
      break;
  }

  $db = Database::instance()->db();
  $stmt = $db->prepare('SELECT *,(SELECT COUNT(*) FROM comment WHERE comment.story == storyID) AS n_comments,channel.name AS channelName,story.author AS storyAuthor,channel.author AS channelAuthor FROM story INNER JOIN user ON user.ID == story.author INNER JOIN channel ON channel.ID == story.channel ORDER BY '.$order.' LIMIT ? OFFSET ?');
  $stmt->execute(array($limit,$offset));
  return $stmt->fetchAll();
}

function getStoriesByUser($username,$sort='',$offset=0,$limit=5) {
  switch($sort){
    case 'mRecent':
      $order = 'storyID DESC';
      break;
    case 'mOld':
      $order = 'storyID ASC';
      break;
    case 'mUpVoted':
      $order = 'upvotes DESC';
      break;
    case 'mDownVoted':
      $order = 'downvotes DESC';
      break;
    case 'mComments':
      $order = 'n_comments DESC';
      break;
    default:
      $order = 'storyID DESC';
      break;
  }

  $db = Database::instance()->db();
  $stmt = $db->prepare('SELECT *,(SELECT COUNT(*) FROM comment WHERE comment.story == storyID) AS n_comments,channel.name AS channelName FROM story INNER JOIN user ON user.ID == story.author INNER JOIN channel ON channel.ID == story.channel  WHERE user.username == ? ORDER BY '.$order.' LIMIT ? OFFSET ?');
  $stmt->execute(array($username,$limit,$offset));
  return $stmt->fetchAll();
}

function getStoriesByChannel($channelID,$sort='',$offset=0,$limit=5) {
  switch($sort){
    case 'mRecent':
      $order = 'storyID DESC';
      break;
    case 'mOld':
      $order = 'storyID ASC';
      break;
    case 'mUpVoted':
      $order = 'upvotes DESC';
      break;
    case 'mDownVoted':
      $order = 'downvotes DESC';
      break;
    case 'mComments':
      $order = 'n_comments DESC';
      break;
    default:
      $order = 'storyID DESC';
      break;
  }

  $db = Database::instance()->db();
  $stmt = $db->prepare('SELECT *,(SELECT COUNT(*) FROM comment WHERE comment.story == storyID) AS n_comments,channel.name AS channelName,story.author AS storyAuthor FROM story INNER JOIN user ON user.ID == story.author INNER JOIN channel ON channel.ID == story.channel  WHERE story.channel == ? ORDER BY '.$order.' LIMIT ? OFFSET ?');
  $stmt->execute(array($channelID,$limit,$offset));
  return $stmt->fetchAll();
}

function getCommentsByStory($storyID,$sort='',$offset=0,$limit=5) {
  switch($sort){
    case 'mRecent':
      $order = 'ID DESC';
      break;
    case 'mOld':
      $order = 'ID ASC';
      break;
    case 'mUpVoted':
      $order = 'upvotes DESC';
      break;
    case 'mDownVoted':
      $order = 'downvotes DESC';
      break;
    default:
      $order = 'ID DESC';
      break;
  }

  $db = Database::instance()->db();
  $stmt = $db->prepare('SELECT *, comment.ID AS comID FROM comment INNER JOIN user ON author == user.ID WHERE comment.story = ? ORDER BY '.$order.' LIMIT ? OFFSET ?');
  $stmt->execute(array($storyID,$limit,$offset));
  return $stmt->fetchAll();
}

function getComment($id) {
  $db = Database::instance()->db();
  $stmt = $db->prepare('SELECT * FROM comment WHERE ID == $id');
  $stmt->execute(array($id));
  return $stmt->fetch();
}

function deleteComment($commentId){
  $db = Database::instance()->db();
  $stmt = $db->prepare('DELETE FROM comment WHERE ID = ?');
  $stmt->execute(array($commentId));
}

function listChannel($sort='') {
  switch($sort){
    case 'mActive':
      $order = 'n_stories DESC';
      break;
    case 'lActive':
      $order = 'n_stories ASC';
      break;
    case 'alphabetical':
      $order = 'name ASC';
      break;
    default:
      $order = 'n_stories DESC';
      break;
  }

  $db = Database::instance()->db();
  $stmt = $db->prepare('SELECT *,(SELECT COUNT(*) FROM story WHERE story.channel == channel.ID) AS n_stories,channel.ID as channelId FROM channel INNER JOIN user ON author=user.ID ORDER BY '.$order);
  $stmt->execute();
  return $stmt->fetchAll();
}


?>
