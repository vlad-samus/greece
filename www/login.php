<?php

require_once('php/init.php');
$login = @strtolower($_POST['login']);
$password = @$_POST['password'];
if(empty($USER) &&
	!empty($login) &&
	!empty($password) &&
	array_key_exists($login, $USERS) &&
	($USERS[$login]['pass']==$password) &&
	($USERS[$login]['banned']!=true))
{
	$USER = $_SESSION['user'] = $login;
	header("HTTP/1.1 302 Redirect");
	header("Location: /");
}
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