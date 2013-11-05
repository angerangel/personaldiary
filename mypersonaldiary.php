<?php
require_once('check.php');
#we got $username
$query = "SELECT id FROM users WHERE user='$username' ";
$row = $db->query($query)->fetch();
$id = $row[0];
#first post number  in the page
$p = 0; 
if (isset($_GET['p'])) {$p=$_GET['p'];}
#here there are how many posts visualize per page:
$oldpost = 30 ;
?>
<div align=center>
<h1>My personal Diary of  <?php echo $username;?></h1>

<a href=search.php>Search</a>
<?php
$query = "SELECT id FROM users WHERE user='$username'";
$user_ID = $db->query($query)->fetch();
$user_ID = $user_ID[0];
$query = "SELECT status FROM admins WHERE id=$user_ID";
$status = $db->query($query)->fetch();
$status = $status[0];

if($status === "true") {		
		echo " - <a href=admin.php >Administration </a>";
		}
?>	

<form action=addpost.php method=post >
Date: <input type=date name=date  value=<?php  $query = "SELECT date('now') " ; $row = $db->query($query)->fetch();  echo $row[0] ;  ?>     >
<br>
<textarea style="width:50%; height:30%;" name=text ></textarea> <br>
<input type=hidden name=user value="<?php echo $username;?>">
<input type=submit name=submit >
</form>


<?php 


$query = "SELECT id,day,text FROM posts WHERE userid=$id ORDER BY day DESC  LIMIT $oldpost  OFFSET $p ";

$row = $db->query($query);
?>
<!--pop up confirmation code-->
<script LANGUAGE="JavaScript">
<!--
function confirmPost()
{
var agree=confirm("Are you sure you want to delete this post?");
if (agree)
return true ;
else
return false ;
}
// -->
</script>

<table  width=50% border=0 >
<?php
foreach ($row as $post ) {
	echo "<tr>";
	echo "<td valign=top width=3><i><small>".$post['day'].":</small></i></td>";
	echo "<td valign=top align=justify >". nl2br($post['text']).  " </td>";	
	echo "<td align=right ><form action=delpost.php method=post><input type=hidden name=id value=".$post['ID']." ><input type=submit value=X  onClick=\"return confirmPost()\"></form></td>";
	echo "</tr>";
	}
?>
</table>
<br>
<table  width=50% border=0 >
<tr><td width=20% align=left>
<?php 
#navigation liks between posts for newer posts
if (isset($_GET['p'])) {
	$p0 = $p - $oldpost;
	if ($p0 > 0) {
		echo "<a href=mypersonaldiary.php?p=$p0 >Newer posts</a>"; 
		} else {
		echo "<a href=mypersonaldiary.php >Newer posts</a>"; 
		}
	}
?>
</td>
<td align=center>
<?php
#bottom string with post counter
$query="SELECT count(id) FROM posts WHERE userid=$id  ";
$row = $db->query($query)->fetch();
$total_post = $row[0];
$pp= $total_post - $p;
$current = $p + $oldpost;
if ($current > $total_post) {$current = $total_post;}
$bottomstring = "Seeing posts ";
if ($p > 0) { 
	$bottomstring .= "$p - " ;
	} else {
	$bottomstring .= "1 - " ;
	}
$bottomstring .= "$current of $total_post";	
echo $bottomstring ;
?>
</td>
<td width=20% align=right>
<?php
if ($pp > $oldpost) { 
	$p2 = $p + $oldpost;
	echo "<a href=mypersonaldiary.php?p=$p2 >Older posts</a>";
	}
?>
</td>
</tr>
</table>

<hr>
<small><a href=logout.php>Logout</a></small>
</div>
