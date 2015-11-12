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
$do = '/' . @$_GET['do'];

?>

<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Стародавня Греція</title>
	<link type"text/css" rel="stylesheet" href="/css/style.css" />
	<link type"text/css" rel="stylesheet" href="/css/style-toolbar.css" />
	<link type"text/css" rel="stylesheet" href="/css/style-registration.css" >
	<link type"text/css" rel="stylesheet" href="/css/style-section.css" >
	<link type"text/css" rel="stylesheet" href="/css/style-comments.css" >
	<link type"text/css" rel="stylesheet" href="/css/style-admin.css" >
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<script type="text/javascript" src="/js/script.js"></script>
	<script type="text/javascript" src="/js/script-lib.js"></script>
	<script type="text/javascript" src="/js/script-actions.js"></script>
	<script type="text/javascript" src="/js/script-parts.js"></script>
</head>

<body>
	<div id="user-bar">

<?php
if($do!='/' || !empty($USER)){
	print('<style type="text/css"> div#login{ display: none; } </style>');
}
if(empty($USER)){
	print('<style type="text/css"> div#toolbar{ display: none; } </style>');
}
//
$file = 'html-content/action-login.html';
$content = file_get_contents($file);
print($content);	
//
$file = 'html-content/action-toolbar.html';
ob_start();
$_user = array(
	'login' => @$USER['login'],
	'admin' => @$USER['admin'],
	'logined' => !empty($USER)
);
include($file);
$content = ob_get_clean();
ob_end_clean();
print($content);
?>

	</div>
	<section id="section1">

<?php
$DO = array(
	'/' => 'index.html',
	'/personality' => 'personality.html',
	'/architecture-afiny' => 'architecture-afiny.html',
	'/history' => 'history.html',
	'/history-arhaichna-greece' => 'history-arhaichna-greece.html',
	'/history-classick-greece' => 'history-classick-greece.html',
	'/history-ellinist-greece' => 'history-ellinist-greece.html',
	'/art' => 'art.html'
);
if(array_key_exists($do, $DO)){
	$file = 'html-content/' . $DO[$do];
	$content = file_get_contents($file);
	print($content);
}
elseif($do=='/admin'){
	if(!empty($USER) && !$USER['banned'] && $USER['admin']){
		foreach ($USERS as $login => $user){
			if($login=='root') continue;
			$file = 'html-content/action-admin.html';
			ob_start();
			$_user = $user;
			include($file);
			$content = ob_get_clean();
			ob_end_clean();
			print($content);
		}
		print('<hr>');
	}
	// action-comment-view.html	
	$_admin = (!empty($USER) && !$USER['banned'] && $USER['admin']);
	$comments = commentsImport($fileCommentsBase);
	if(empty($USER) || !$USER['admin']){
		$comments = array_filter($comments, commentShown);
	}
	$_comments_keys = array_keys($comments);
	$_comments_count = count($comments);
	$_comments_per_page = 10;
	$_page = intval(@$_GET['page']);
	$_page_count = ceil($_comments_count/$_comments_per_page);
	print('<div class="comments">');
	for($i=$_page*$_comments_per_page; $i<min($_comments_count, ($_page+1)*$_comments_per_page); $i++){
		$id = $_comments_keys[$i];
		$comment = $comments[$id];
		$file = 'html-content/action-comment-view.html';
		ob_start();
		$_comment = array(
			'index' => @$i+1,
			'id' => @$id,
			'user' => @$comment['user'],
			'date' => @$comment['date'],
			'data' => @$comment['data'],
			'moderated' => @$comment['moderated'],
			'bann' => $_admin,
			'moderate' => $_admin,
			'uncomment' =>  $_admin || (@$comment['user']===@$USER['login'])
		);
		include($file);
		$content = ob_get_clean();
		ob_end_clean();
		print($content);
	}
	print('</div>');
	print('<div class="pages">');
	for ($i=0; $i<$_page_count; $i++){
		$file = 'html-content/action-pages.html';
		ob_start();
		$_page_sep = $i==0 ? '' : '|';
		$_page_index = $i;
		include($file);
		$content = ob_get_clean();
		ob_end_clean();
		print($content);
	}
	print('</div>');
}
elseif($do=='/architecture'){
	$file = 'html-content/architecture.html';
	$content = file_get_contents($file);
	print($content);
	//
	if(empty($USER)){
		print('<style type="text/css"> div#comment-add{ display: none; } </style>');
	}
	if(!empty($USER) && 0){
		print('<style type="text/css"> div.comment-view{ display: none; } </style>');
	}
	// action-comment-add.html
	$file = 'html-content/action-comment-add.html';
	$content = file_get_contents($file);
	print($content);
	// action-comment-view.html	
	$_admin = (!empty($USER) && !$USER['banned'] && $USER['admin']);
	$comments = commentsImport($fileCommentsBase);
	if(empty($USER) || !$USER['admin']){
		$comments = array_filter($comments, commentShown);
	}
	$_comments_keys = array_keys($comments);
	$_comments_count = count($comments);
	$_comments_per_page = 10;
	$_page = intval(@$_GET['page']);
	$_page_count = ceil($_comments_count/$_comments_per_page);
	print('<div class="comments">');
	for($i=$_page*$_comments_per_page; $i<min($_comments_count, ($_page+1)*$_comments_per_page); $i++){
		$id = $_comments_keys[$i];
		$comment = $comments[$id];
		$file = 'html-content/action-comment-view.html';
		ob_start();
		$_comment = array(
			'index' => @$i+1,
			'id' => @$id,
			'user' => @$comment['user'],
			'date' => @$comment['date'],
			'data' => @$comment['data'],
			'moderated' => @$comment['moderated'],
			'bann' => $_admin,
			'moderate' => $_admin,
			'uncomment' =>  $_admin || (@$comment['user']===@$USER['login'])
		);
		include($file);
		$content = ob_get_clean();
		ob_end_clean();
		print($content);
	}
	print('</div>');
	print('<div class="pages">');
	for ($i=0; $i<$_page_count; $i++){
		$file = 'html-content/action-pages.html';
		ob_start();
		$_page_sep = $i==0 ? '' : '|';
		$_page_index = $i;
		include($file);
		$content = ob_get_clean();
		ob_end_clean();
		print($content);
	}
	print('</div>');
}
elseif($do=='/registration'){
	if(!empty($USER)){
		print('<style type="text/css"> div#registration-add{ display: none; } </style>');
	}
	if(empty($USER)){
		print('<style type="text/css"> div#registration-view{ display: none; } </style>');
	}
	//
	$file = 'html-content/action-registration-add.html';
	$content = file_get_contents($file);
	print($content);
	//
	$file = 'html-content/action-registration-view.html';
	ob_start();
	$_user = array(
		'login' => @$USER['login'],
		'email' => @$USER['email'],
		'admin' => @$USER['admin'],
		'banned' => @$USER['banned'],
		'name' => @$USER['name'],
		'birthday' => @$USER['birthday'],
		'sex' => @$USER['sex'],
		'country' => @$USER['country'],
		'info' => @$USER['info']
	);
	include($file);
	$content = ob_get_clean();
	ob_end_clean();
	print($content);
}
?>

	</section>

	<header>
		<a href="/" id="logo"><img src="/img/logo.png" alt="logo" ></a>
		<ul id="menu">
			<li><a href="/personality">Особистості</a>
			<ul>
			 <li><a href="/personality#mnesikl">Мнесікл</a></li>
			 <li><a href="/personality#iktin">Іктін</a></li>
			 <li><a href="/personality#pasha">Каллікрат</a></li>
			 <li><a href="/personality#fidii">Фідій</a></li>
			</ul>
			</li>
			<li><a href="/architecture">Архітектура</a></li>
			<li><a href="/history">Історія</a></li>
			<li><a href="/art">Мистецтво</a></li>
			<li><a href="/registration">Реєстрація</a></li>
		</ul>
	</header>

	<footer>
		© Copyright @ 2015  Vladislav Samusenko. Kyiv. NTUU "KPI"
	</footer>
</body>

</html>

<?php 

usersExport($fileUsersBase, $USERS);
session_write_close();

?>
