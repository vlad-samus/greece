<?php

require_once('php/init.php');
$login = @strtolower($_POST['login']);
$password = @$_POST['password'];
$password2 = @$_POST['password2'];
$email = @$_POST['email'];
$admin = false;
$banned = false;
$data = userData($_POST);
function emailU($v){
	global $email;	
	return $v["email"]==$email;
};
if(empty($USER) &&
	!empty($login) &&
	!empty($password) &&
	!empty($password2) &&
	($password==$password2) &&
	!array_key_exists($login, $USERS) &&
	(count(array_filter($USERS, emailU))==0) &&
	!empty($data[name]) &&
	!empty($data[date]) &&
	!empty($data[sex]) &&
	!empty($data[country]) &&
	!empty($data[accept]))
{
	$USERS[$login] = array(
		'pass' => $password,
		'email' => $email,
		'admin' => $admin,
		'banned' => $banned,
		'data' => $data
	);
	$USER = $_SESSION['user'] = $login;
	@header("HTTP/1.1 302 Redirect");
	@header("Location: /");
}
else{
	@header("HTTP/1.1 403 Deny");
?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="refresh" content="5;url=/auth.php">
</head>
<body>Deny! <a href="/auth.php">back</a></body>
</html>

<?
}
require_once('php/uninit.php');
?>