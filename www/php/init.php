<?php

ignore_user_abort(true);
set_time_limit(0);
session_start();
$USER = @$_SESSION['user'];
require_once('lib.php');
$fileUsersBase = $_SERVER['DOCUMENT_ROOT'] . '/php/users-base.txt';
$fileCommentsBase = $_SERVER['DOCUMENT_ROOT'] . '/php/comments-base.txt';
$USERS = usersImport($fileUsersBase);

?>