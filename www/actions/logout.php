<?php

require_once('../php/init.php');
unset($_SESSION['user']);
header("HTTP/1.1 302 Redirect");
header("Location: /");
require_once('../php/uninit.php');

?>