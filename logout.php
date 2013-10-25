<?php
unset($_COOKIE['mypersonaldiary']);
setcookie("mypersonaldiary", "" , time()-3600);
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = 'index.php';
header('Location: http://' . $host . $uri . "/" . $extra);
exit;		
?>