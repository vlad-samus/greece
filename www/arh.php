<?php require_once('php/init.php'); ?>

<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
	<title>Стародавня Греція</title>
	<link type"text/css" rel="stylesheet" href="/css/style.css" >
	<link type"text/css" rel="stylesheet" href="/css/style-section.css" >
	<link type"text/css" rel="stylesheet" href="/css/style-comments.css" >
</head>

<body>
	<section id="section1">
		<div style="border: 1px solid gray; border-radius: 8px; text-align: center;">
			<h3><a href="/arh-afini.php">Афіни</a></h3>
			<h3><a href="/arh-saloniki.html">Салоніки</a></h3>
			<h3><a href="/arh-sparta.html">Спарта</a></h3>
			<h3><a href="/arh-iraklion.html">Іракліон</a></h3>
			<h3><a href="/arh-fivi.html">Фіви</a></h3>
		</div>
		<?php include('parts/comments.php'); ?>
	</section>

	<?php include('parts/header.php'); ?>
	<?php include('parts/footer.php'); ?>
</body>

</html>

<?php require_once('php/uninit.php'); ?>
