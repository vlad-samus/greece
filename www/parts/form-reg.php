<?php

if(empty($USER)){
?>

<form method="post" action="/reg.php" class="reg">	
	<dl>
		<dt>Ім'я*:</dt>
		<dd><input type="text" name="name" value="" size="20" required="required" ></dd>
		<dt>Логін*:</dt>
		<dd><input type="text" name="login" value="" size="20" required="required" ></dd>
		<dt>Пароль*:</dt>
		<dd><input type="password" name="password" value="" size="20" required="required"></dd>
		<dt>Повторіть Пароль*:</dt>
		<dd><input type="password" name="password2" value="" size="20" required="required"></dd>
		<dt>E-mail*:</dt>
		<dd><input type="email" name="email" value="" size="20" required="required"></dd>
		<dt>Дата народження*:</dt>
		<dd><input type="date" name="date" value="" required="required"></dd>
		<dt>Стать:</dt>
		<dd>
			<input type="radio" name="sex" id="sex1" value="m"><label for="sex1">чоловіча</label><br>
			<input type="radio" name="sex" id="sex2" value="f"><label for="sex2">жіноча</label><br>				
		</dd>
		<dt>Місце народження:</dt>
		<dd>
			<select name="country">
				<option value="ua">Україна</option>
				<option value="es">Естонія</option>
				<option value="kz">Казахстан</option>
				<option value="ml">Молдова</option>
				<option value="us">США</option>
				<option value="de">Німеччина</option>
				<option value="sh">Швейцарія</option>
			</select>
		</dd>
		<dt>Додаткова інформація:</dt>
		<dd><textarea name="information" rows="5" cols="22"></textarea></dd>
		<dt>Я приймаю умови цього сайту*</dt>
		<dd><input name="accept" type="checkbox" required="required"></dd>
	</dl>
	<div>* - Поля обов'язкові для введення</div>
	<div>
		<input type="reset" value="Очистити">
		<button type="submit"><img src="/img/галочка.jpg" width="12px"> Підтвердити</button>
	</div>
</form>

<?	
} 
else{
?>

<div class="reg">
	<span class="login"><?=$USER;?></span>
	<span class="email"><?=$USERS[$USER]['email'];?></span>
	<span class="admin"><?=$USERS[$USER]['admin'] ? 'admin' : 'user';?></span>
	<span class="banned"><?=$USERS[$USER]['banned'] ? 'banned' : 'not banned';?></span>
	<span class="name"><?=$USERS[$USER]['data']['name'];?></span>
	<span class="date"><?=$USERS[$USER]['data']['date'];?></span>
	<span class="sex"><?=$USERS[$USER]['data']['sex']=='m' ? 'male' : 'female';?></span>
	<span class="country"><?=$USERS[$USER]['data']['country'];?></span>
	<span class="information"><?=$USERS[$USER]['data']['information'];?></span>
	<span class="accept"><?=$USERS[$USER]['data']['accept'] ? 'yes' : 'no';?></span>	
</div>

<?
}
?>
