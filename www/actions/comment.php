<?php

require_once('../php/init.php');
$user = @strtolower($_POST['user']);
$data = @$_POST['data'];
if(!empty($USER) &&
	!empty($data) &&
	($user==$USER))
{
	date_default_timezone_set('Europe/Kiev');
	$comments = commentsImport($fileCommentsBase);
	$comment = array(
		'user' => $user,
		'date' => date('Y-m-d H:i:s'),
		'data' => $data,
		'moderated' => $USERS[$USER]['admin'] ? $USER : false
	);
	array_push($comments, $comment);
	commentsExport($fileCommentsBase, $comments);
	header("HTTP/1.1 302 Redirect");
	header("Location: /arh.php");
}
else{
	header("HTTP/1.1 403 Deny");
?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="refresh" content="5;url=/arh.php">
</head>
<body>Deny! <a href="/arh.php">back</a></body>
</html>

<?
}
require_once('../php/uninit.php');

?>