
<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
	<title>Стародавня Греція</title>
	<link type"text/css" rel="stylesheet" href="/css/style.css" >
	<link type"text/css" rel="stylesheet" href="/css/style-section.css" >
	<link type"text/css" rel="stylesheet" href="/css/style-auth.css" >
</head>

<body>
	<section id='section1'>
		<dl id='table1'>
			<dt>Ім'я*:</dt>
			<dd><input type="text" name="login" value="" size="10" required="required" ></dd>
			<dt>Логін*:</dt>
			<dd><input type="text" name="login" value="" size="10" required="required" ></dd>
			<dt>Пароль*:</dt>
			<dd><input type="password" name="password" value="" size="10" required="required"></dd>
			<dt>Повторіть Пароль*:</dt>
			<dd><input type="password" name="password" value="" size="10" required="required"></dd>
			<dt>Дата народження*:</dt>
			<dd><input type="date" name="date" value="" required="required"></dd>
			<dt>Стать:</dt>
			<dd>
				<input type="radio" name="sex" id="sex1" value="male"><label for="sex1">чоловіча</label><br>
				<input type="radio" name="sex" id="sex2" value="female"><label for="sex2">жіноча</label><br>				
			</dd>
			<dt>Місце народження:</dt>
			<dd>
				<select>
					<option>Україна</option>
					<option>Естонія</option>
					<option>Казахстан</option>
					<option>Молдова</option>
					<option>США</option>
					<option>Німеччина</option>
					<option>Швейцарія</option>
				</select>
			</dd>
			<dt>Додаткова інформація:</dt>
			<dd><textarea name="information" rows="5" cols="22"></textarea></dd>
			<dt>Я приймаю умови цього сайту*</dt>
			<dd><input type="checkbox" required></dd>
			<dt><input type="reset" value="Очистити"></dt>
			<dd>* - Поля обов'язкові для введення</dd>
		</dl>
		<div><button type="submit" value="ок"><img src="/img/галочка.jpg" width="12px"> Підтвердити</button></div>
	</section>

	<?php include('parts/header.php'); ?>
	<?php include('parts/footer.php'); ?>
</body>

</html>
