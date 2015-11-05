<?php

require_once('../php/init.php');
$comment = @strtolower($_GET['comment']);
$comments = commentsImport($fileCommentsBase);
if(!empty($USER) &&
	($USERS[$USER]['banned']==false) &&
	($USERS[$USER]['admin']==true) &&
	!empty($comment) &&
	array_key_exists($comment, $comments))
{
	$comments[$comment] = null;
	unset($comments[$comment]);
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