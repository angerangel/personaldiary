<?php
require_once('check.php');
#we got $username and $db

#we got from POST:
$id = $_POST['id'];
#deleting post
$query = "DELETE FROM posts WHERE id=$id  ; ";	
$db->query($query) ;	

#redirect
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = 'mypersonaldiary.php';
header('Location: http://' . $host . $uri . "/" . $extra);
exit;

?>