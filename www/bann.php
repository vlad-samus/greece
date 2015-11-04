<?php

require_once('php/init.php');
$login = @strtolower($_GET['login']);
if(!empty($USER) &&
	($USERS[$USER]['banned']==false) &&
	($USERS[$USER]['admin']==true) &&
	!empty($login) &&
	array_key_exists($login, $USERS))
{
	$USERS[$login]['banned'] = true;
	header("HTTP/1.1 302 Redirect");
	header("Location: /arh.php");}
else{
	header("HTTP/1.1 403 Deny");
?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="refresh" content="5;url=/">
</head>
<body>Deny! <a href="/">back</a></body>
</html>

<?
}
require_once('php/uninit.php');

?>