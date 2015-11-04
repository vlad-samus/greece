<?php

ignore_user_abort(true);
set_time_limit(0);
session_start();
$USER = @$_SESSION['user'];
require_once('php/lib.php');
$fileUsersBase = 'php/users-base.txt';
$fileCommentsBase = 'php/comments-base.txt';
$USERS = usersImport($fileUsersBase);

?>