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

if(count($_POST)>0 && $_POST['action']=='registration'){
	$login = trim(strtolower(@$_POST['login']));
	$password = @$_POST['password'];
	$password2 = @$_POST['password2'];
	$email = @$_POST['email'];
	$admin = false;
	$banned = false;
	$name = @$_POST['name'];
	$birthday = @$_POST['birthday'];
	$sex = @$_POST['sex'];
	$country = @$_POST['country'];
	$info = @$_POST['info'];
	$accept = @$_POST['accept'];
	function emailU($v){
		global $email;	
		return $v['email']==$email;
	};
	if(empty($USER) &&
		!empty($login) &&
		!empty($password) &&
		!empty($password2) &&
		!empty($email) &&
		!empty($name) &&
		!empty($birthday) &&
		!empty($sex) &&
		!empty($country) &&
		!empty($accept) &&
		($password==$password2) &&
		!array_key_exists($login, $USERS) &&
		(count(array_filter($USERS, emailU))==0))
	{
		$USERS[$login] = array(
			'login' => $login,
			'pass' => $password,
			'email' => $email,
			'admin' => $admin,
			'banned' => $banned,
			'name' => $name,
			'birthday' => $birthday,
			'sex' => $sex,
			'country' => $country,
			'info' => $info
		);
		$_SESSION['user'] = $login;
		header("HTTP/1.1 302 Redirect");
		header(sprintf('Location: %s', $url));
	}
}
elseif(count($_POST)>0 && $_POST['action']=='login'){
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
		header("HTTP/1.1 302 Redirect");
		header(sprintf('Location: %s', $url));
	}
}
elseif(count($_GET)>0 && $_GET['action']=='logout'){
	unset($_SESSION['user']);
	header("HTTP/1.1 302 Redirect");
	header(sprintf('Location: %s', $url));
}
elseif(count($_GET)>0 && $_GET['action']=='bann'){
	$login = @strtolower($_GET['login']);
	if(!empty($USER) &&
		!$USER['banned'] &&
		$USER['admin'] &&
		!empty($login) &&
		array_key_exists($login, $USERS))
	{
		$USERS[$login]['banned'] = true;
		header("HTTP/1.1 302 Redirect");
		header(sprintf('Location: %s', $url));
	}
}
elseif(count($_GET)>0 && $_GET['action']=='unbann'){
	$login = @strtolower($_GET['login']);
	if(!empty($USER) &&
		!$USER['banned'] &&
		$USER['admin'] &&
		!empty($login) &&
		array_key_exists($login, $USERS))
	{
		$USERS[$login]['banned'] = false;
		header("HTTP/1.1 302 Redirect");
		header(sprintf('Location: %s', $url));
	}
}
elseif(count($_GET)>0 && $_GET['action']=='moderate'){
	$comment = @$_GET['comment'];
	$comments = commentsImport($fileCommentsBase);
	if(!empty($USER) &&
		!$USER['banned'] &&
		$USER['admin'] &&
		array_key_exists($comment, $comments))
	{
		$comments[$comment]['moderated'] = $USER['login'];
		commentsExport($fileCommentsBase, $comments);
		header("HTTP/1.1 302 Redirect");
		header(sprintf('Location: %s', $url));
	}
}
elseif(count($_POST)>0 && $_POST['action']=='comment-add'){
	$data = @$_POST['data'];
	if(!empty($USER) &&
		!empty($data))
	{
		date_default_timezone_set('Europe/Kiev');
		$comments = commentsImport($fileCommentsBase);
		$comment = array(
			'user' => $USER['login'],
			'date' => date('Y-m-d H:i:s'),
			'data' => $data,
			'moderated' => $USER['admin'] ? $USER['login'] : false
		);
		array_push($comments, $comment);
		commentsExport($fileCommentsBase, $comments);
		header("HTTP/1.1 302 Redirect");
		header(sprintf('Location: %s', $url));
	}
}
elseif(count($_GET)>0 && $_GET['action']=='uncomment'){
	$comment = @$_GET['comment'];
	$comments = commentsImport($fileCommentsBase);
	if(!empty($USER) &&
		!$USER['banned'] &&
		$USER['admin'] &&
		array_key_exists($comment, $comments))
	{
		$comments[$comment] = null;
		unset($comments[$comment]);
		commentsExport($fileCommentsBase, $comments);
		header("HTTP/1.1 302 Redirect");
		header(sprintf('Location: %s', $url));
	}
}
else{
	header("HTTP/1.1 403 Deny");
	$file = 'html-content/action-redirect.html';
	ob_start();
	$_url = $url;
	include($file);
	$content = ob_get_clean();
	ob_end_clean();
	print($content);	
}

usersExport($fileUsersBase, $USERS);
session_write_close();

?>