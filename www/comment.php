<?php

require_once('php/init.php');
$data = @strtolower($_POST['data']);
if(!empty($USER) &&
	!empty($data))
{
	date_default_timezone_set('Europe/Kiev');
	$comments = commentsImport($fileCommentsBase);
	array_push($comments, array(
		'user' => $USER,
		'date' => date('Y-m-d H:i:s'),
		'data' => $data
		));
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
require_once('php/uninit.php');

?>