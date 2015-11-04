<?php require_once('php/init.php'); ?>

<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Стародавня Греція</title>
	<link type"text/css" rel="stylesheet" href="/css/style.css" />
	<link type"text/css" rel="stylesheet" href="/css/style-index.css" />
</head>

<body>
	<section>
		<div><?php include('parts/form-login.php'); ?></div>
		<div class="p-map">
			<img src="/img/Карта.jpg" usemap="#map" alt="Мапа" >
			<map name="map" id="map">
				<area shape="rect" coords="110,197,188,627" href="/osob.php" alt="Особистості">
				<area shape="rect" coords="375,222,451,624" href="/arh.php" alt="Архітектура">
				<area shape="rect" coords="626,224,706,621" href="/history.php" alt="Історія">
				<area shape="rect" coords="870,230,962,621" href="/mist.php" alt="Мистецтво">
			</map>
		</div>
	</section>
</body>

</html>

<?php require_once('php/uninit.php'); ?>
