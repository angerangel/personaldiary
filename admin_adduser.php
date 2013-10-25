<?php
require_once('check.php');
//$db contains DB connection
//$username
require_once('check_adm.php');
# $user_ID

#check if there is the POST
if(isset($_POST['submit'])){
	#we must update
	#users table	
	#admins table	
	#$_POST contains:
	#username
	#password
	$username = $_POST['username'];	
	$password = $_POST['password'];	
	#let's see if user alredy exists:
	$query = "SELECT user FROM users WHERE user='$username'";
	$result = $db->query($query)->fetch();		
	$result = $result[0];
	if  ($result == "") {		
		#OK
		
		##USERS table
		$query = "INSERT INTO users (user,password) VALUES ('$username','$password')"  ;
		$db->query($query);
		##END USERS table
		
		##ADMIN table
		#let's update admin table
		$query = "SELECT id FROM users WHERE user='$username' " ;
		$row = $db->query($query)->fetch();		
		$ID_user = $row[0];
		$query = "INSERT INTO admins (ID,status) VALUES ($ID_user,'false')"  ;
		$db->query($query);
		##END ADMIN table
				
		echo "<div align=center><b><font color=green>USER: $username added!</font></b></div>";
		} else {
		echo "<b><font color=red>ERROR: User already exists!</font></b></div>";
		}	
	}

require_once('admin.php');

?>