<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo("Hello World \r\n");


$dbh = new PDO('sqlite:database.db');
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

$username = "tiaguinho";
$email = "tiago@tiago.com";
$password = "123456";
$birth = "01/07/1998";
$profilePic = "image.png";
$channel = 0;



try{
  /*
  for ($i=0; $i < 100; $i++) {
    $usernameNew = $username . $i;
    $stmt = $dbh->prepare('INSERT INTO user (username,email,password,birth,profilePic,channel) VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->execute(array($usernameNew, $email, $password, $birth, $profilePic, $channel));
  }*/
} catch (Exception $e) {
    echo($e);
}

echo ("<pre>");
$stmt = $dbh->prepare('SELECT * FROM user');
$stmt->execute();
while ($row = $stmt->fetch()) {
  print_r ($row);
}
echo("</pre>");







?>
