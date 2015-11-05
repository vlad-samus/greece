<?php

require_once('php/init.php');

if(!empty($USER) &&
	($USERS[$USER]['banned']==false) &&
	($USERS[$USER]['admin']==true))
{
?>

<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
	<title>Стародавня Греція</title>
	<link type"text/css" rel="stylesheet" href="/css/style.css" >
	<link type"text/css" rel="stylesheet" href="/css/style-section.css" >
	<link type"text/css" rel="stylesheet" href="/css/style-admin.css" >
</head>

<body>
	<section id="section1">

<?php
	foreach ($USERS as $login => $user){
		if($login=='root') continue;
?>
		<div class="admin">
			<span class="login"><?=$login;?></span>
			<span class="password"><?=$USERS[$login]['pass'];?></span>
			<span class="email"><?=$USERS[$login]['email'];?></span>
			<span class="admin"><?=$USERS[$login]['admin'] ? 'admin' : 'user';?></span>
			<span class="banned"><?=$USERS[$login]['banned'] ? 'banned' : 'not banned';?></span>
			<span class="name"><?=$USERS[$login]['data']['name'];?></span>
			<span class="date"><?=$USERS[$login]['data']['date'];?></span>
			<span class="sex"><?=$USERS[$login]['data']['sex']=='m' ? 'male' : 'female';?></span>
			<span class="country"><?=$USERS[$login]['data']['country'];?></span>
			<span class="information"><?=$USERS[$login]['data']['information'];?></span>
			<span class="accept"><?=$USERS[$login]['data']['accept'] ? 'yes' : 'no';?></span>	
			<span class="bann"><a href="/actions/bann.php?login=<?=$login; ?>">bann user</a></span>
			<span class="unbann"><a href="/actions/unbann.php?login=<?=$login; ?>">unbann user</a></span>
		</div>

<?php
	}
?>

	</section>

	<?php include('parts/header.php'); ?>
	<?php include('parts/footer.php'); ?>
</body>

</html>

<?php
}
else{
	header("HTTP/1.1 403 Deny");
?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="refresh" content="5;url=/">
</head>
<body>Deny! <a href="/">back</a></body>
</html>

<?php
}

require_once('php/uninit.php');

?>
