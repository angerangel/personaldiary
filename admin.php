<?php 
require_once('check.php');
//$db contains DB connection
//$username
require_once('check_adm.php');

//Create list of users
$query = "SELECT ID, user FROM users ORDER BY user" ;
$users = $db->query($query);
//Create list of files
$query = "SELECT ID, filename, version FROM files ORDER BY filename" ;
$files = $db->query($query);
//creta list of permissions
$query = "SELECT ID_files, ID_user FROM permissions " ;
$perms = $db->query($query); 
?>
<div align=center>
<h1><a name=top>Administration</a></h1>

<a href=#backup >Backup</a> - <a href=mypersonaldiary.php >Go back to personal diary</a>


<hr><h2><a name=users>Users</a></h2>
<h3>Add an user</h3>

<form action=admin_adduser.php method=post >
<table border=0 >
<tr><td>User name: </td><td><input type=text name=username></td></tr>
<tr><td>Password:</td><td> <input type=password name=password></td></tr>
</table>
<input type=submit name=submit value="Add user">
</form>


<h3>Modify user password</h3>
<form action=admin_moduser.php method=post >
<table border=0 >
<tr><td>User name: </td>
<td><select name=userID><?php 
$query = "SELECT user,ID FROM users ORDER BY user" ;
$users = $db->query($query);
foreach ($users as $user) {	
	echo "<option value=".$user['ID']." >".$user['user']."</option>";
	}
?></select></td></tr>
<tr><td>Password: </td><td><input type=password name=password></td></tr>
</table>

<input type=submit name=submit value="Modify password">
</form>


<h3>Administrators</h3>
<form action=admin_admins.php method=post>
<table border=1>
<tr><th>User</th><th>Administrators</th></tr>
<?php
$query="SELECT users.id,users.user,admins.status FROM users, admins WHERE users.id=admins.id ORDER BY users.user ";
$users = $db->query($query);
foreach ($users as $user) {
	echo "\n<tr><td>".$user['user']."</td><td><input type=checkbox name=\"user[". $user['ID'] ."]\" ";
	if ($user['status'] == "true") { echo " checked=checked ";	}
	echo " ></td></tr>";
	}
?>
</table>
<input type=submit name=submit value="Change administrators">
</form>


<h3>Delete an user</h3>
<form action=admin_deluser.php method=post >
<table border=0 >
<tr>
	<td valign=middle ><img src=warning.png  width=30px ></td>
	<td valign=middle>User name: <select name=username >
<?php 
$query = "SELECT user,ID FROM users ORDER BY user" ;
$users = $db->query($query);
foreach ($users as $user) {	
	echo "<option value=".$user['ID']." >".$user['user']."</option>";
	}
?>
</select>
<input  type=submit name=submit value="Delete user" style="color: red;">
</td></tr></table>
</form>

<a href=#top>go top</a>
<hr>
<h2><a name=backup>Backup</a></h2>
<a href=backup.php > Download backup file</a>
<br><br>
<a href=#top>go top</a>
<hr>
<small><a href=logout.php>logout</a></small>
</div>