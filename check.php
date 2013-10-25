
<?php

if(isset($_COOKIE['mypersonaldiary'])){
	$temp_arr = explode("::", $_COOKIE['mypersonaldiary']) ;
	$username = $temp_arr[0];
	$password =  $temp_arr[1];
	$db = new PDO('sqlite:secret/db.sqlite');
	$query = "SELECT password FROM users WHERE user='" . $username . "' ; " ;	
	$row = $db->query($query)->fetch();
	if($password === $row[0]) {		
		setcookie("mypersonaldiary", $username . "::" . $password , time()+60*60*8); //8 hours is enough
		} else {
		//wrong authentication, we go to the login page:
		require_once('logout.php');
		}	
	} else { 
	require_once('logout.php');
	}
?>