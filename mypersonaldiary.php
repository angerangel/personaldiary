<?php
require_once('check.php');
#we got $username
$query = "SELECT id FROM users WHERE user='$username' ";
$row = $db->query($query)->fetch();
$id = $row[0];
$p = 0;
if (isset($_GET['p'])) {$p=$_GET['p'];}
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
#here there are old post, just last 30...
$oldpost = 30 ;

$query = "SELECT id,day,text FROM posts WHERE userid=$id ORDER BY day DESC  LIMIT $oldpost  OFFSET $p ";

$row = $db->query($query);
?>

<table  width=50% border=0 >
<?php
foreach ($row as $post ) {
	echo "<tr>";
	echo "<td valign=top width=3><i><small>".$post['day'].":</small></i></td>";
	echo "<td valign=top align=justify >". nl2br($post['text']).  " </td>";	
	echo "<td align=right ><form action=delpost.php method=post><input type=hidden name=id value=".$post['ID']." ><input type=submit value=X ></form></td>";
	echo "</tr>";
	}
?>
</table>
<br>
<table  width=50% border=0 >
<tr><td width=20% align=left>
<?php 

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
$query="SELECT count(id) FROM posts WHERE userid=$id  ";
$row = $db->query($query)->fetch();
$total_post = $row[0];
$pp= $total_post - $p;
$current = $p + $oldpost;
if ($current > $total_post) {$current = $totalpost;}
echo "Seeing posts $p - $current of $total_post";
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
