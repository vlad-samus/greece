<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link type"text/css" rel="stylesheet" href="style.css" />
	<title>Стародавня Греція</title>
<style type='text/css'>
	#section1 {
		background: #F1FFDF;
		opacity: 0.95;
		position: absolute;
		left:350px;
		top: 150px;
		padding: 10px 80px 30px 80px;
		border-bottom-left-radius: 60px 40px;
		border-bottom-right-radius: 60px 40px;
		border-top-left-radius: 60px 40px; 
		border-top-right-radius: 60px 40px;
	}
	footer{
		z-index: 100;
		background: #f29f4b;
		position: absolute;
		top:700px;
		left:0px;
		width: 100%;
		height:100px;
		opacity: 0.80;
	}
	#table1 dt{
		clear: left;
		float: left;
		line-height: 200%;
		text-align: right;
		width: 240px;
	}
	#table1 dd{
		margin-left: 244px;
		line-height: 200%;
		position: relative;
	}
	#section1 div:last-child{
		clear: left;
		text-align: center;
	}
</style>
</head>
<body>
	<header>
	<a href='index.html'><img src='logo.jpg' id='logo' width = 100px height = 100px alt='logo' /></a>
		<ul id='menu'>
			<li><a href="osob.html">Особистості</a>
			<ul>
			 <li><a href="osob.html#Mnesikl">Мнесікл</a></li>
			 <li><a href="osob.html#Iktin">Іктін</a></li>
			 <li><a href="osob.html#pasha">Каллікрат</a></li>
			 <li><a href="osob.html#fidii">Фідій</a></li>
			</ul>
			</li>
			<li><a href="arh.html">Архітектура</a></li>
			<li><a href="history.html">Історія</a></li>
			<li><a href="mist.html">Мистецтво</a></li>
			<li><a href="auth.html">Реєстрація</a></li>
		</ul>
	</header>
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
			<div>
				<button  type="submit" value="ок">
					<img src="галочка.jpg" width="12px">
					Підтвердити
				</button>
			</div>
		</section>
		<footer>
            <p align = "center"> © Copyright @ 2015  Vladislav Samusenko. Kyiv. NTUU "KPI" </p>
        </footer>
</body>
</html>