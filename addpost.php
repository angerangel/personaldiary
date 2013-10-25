<?php
require_once('check.php');
#we got $username and $db

#we got from POST:
$username2 = $_POST['user'];
$date = $_POST['date'];
$text = $_POST['text'];


#check that user is the correcto user posting
if  (!($username === $username2 )) {
	require_once('logout.php');
	exit;
	}
#now we insert data
$query = "SELECT id FROM users WHERE user='$username' ";
$row = $db->query($query)->fetch();
$id = $row[0];	
$query = "INSERT INTO posts (userid, day, text) VALUES ($id,'$date','$text') ";
#echo "<br>$query<br>";
$db->query($query);	

$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = 'mypersonaldiary.php';
header('Location: http://' . $host . $uri . "/" . $extra);
exit;

?>