<?php

ignore_user_abort(true);
set_time_limit(0);
session_start();
require_once('php/lib.php');
$fileUsersBase = $_SERVER['DOCUMENT_ROOT'] . '/php/users-base.txt';
$fileCommentsBase = $_SERVER['DOCUMENT_ROOT'] . '/php/comments-base.txt';
$USER = @$_SESSION['user'];
$USERS = usersImport($fileUsersBase);
$USER = @$USERS[$USER];
$url = empty($_SERVER['HTTP_REFERER']) ? '/' : preg_replace('/^(?:.*?[\:][\/]{2})?[^\/]+([\/].*)$/', '$1', $_SERVER['HTTP_REFERER']);

header('Content-Type: text/plain');
if(!(count($_POST)>0)){
	print('error');
}
elseif($_POST['action']=='login'){
	$login = @strtolower($_POST['login']);
	$password = @$_POST['password'];
	if(empty($USER) &&
		!empty($login) &&
		!empty($password) &&
		array_key_exists($login, $USERS) &&
		($USERS[$login]['pass']==$password) &&
		!$USERS[$login]['banned'])
	{
		$_SESSION['user'] = $login;
		print('success');
	}
	else{
		print('error');
	}
}
elseif($_POST['action']=='logout'){
	print($_SESSION['user'] ? 'success' : 'error');
	unset($_SESSION['user']);
}
elseif($_POST['action']=='bann'){
	$login = @strtolower($_POST['login']);
	if(!empty($USER) &&
		!$USER['banned'] &&
		$USER['admin'] &&
		!empty($login) &&
		array_key_exists($login, $USERS))
	{
		$USERS[$login]['banned'] = true;
		print('banned');
	}
	else{
		print('error');
	}
}
elseif($_POST['action']=='unbann'){
	$login = @strtolower($_POST['login']);
	if(!empty($USER) &&
		!$USER['banned'] &&
		$USER['admin'] &&
		!empty($login) &&
		array_key_exists($login, $USERS))
	{
		$USERS[$login]['banned'] = false;
		print('not banned');
	}
	else{
		print('error');
	}
}
else{
	print('ajax.html');
	print("\n");
	var_dump($_POST);
}

usersExport($fileUsersBase, $USERS);
session_write_close();

?>