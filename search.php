<?php
require_once('check.php');
#we got $username and $db
#
?>
<div align=center>
<h1>My personal Diary of  <?php echo $username;?></h1>
<h2>Seach page</h2>
<a href=mypersonaldiary.php>Homepage</a>
<form action=search.php method=post >
Search:<input type=text name=text >
<input type=submit name=submit>
</form>

<?php 

if (isset($_POST['submit'])) {
	#we got
	$text = "%".$_POST['text']."%";	
	$text = str_replace(" ", "%", $text );	
	$query = "SELECT id,day,text FROM posts WHERE text LIKE '$text' ORDER BY day DESC ;";
	$row = $db->query($query) ;
	echo "<table  width=50% border=0 >";
	foreach ($row as $post ) {
		echo "<tr>";
		echo "<td valign=top width=3><i><small>".$post['day'].":</small></i></td>";
		echo "<td valign=top align=justify >". nl2br($post['text']).  " </td>";	
		echo "<td align=right ><form action=delpost.php method=post><input type=hidden name=id value=".$post['ID']." ><input type=submit value=X ></form></td>";
		echo "</tr>";
		}
	echo "</table>";
	}

?>