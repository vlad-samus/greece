<?php
	if(empty($USER)){
?>
<form method="post" action="/login.php" class="login">
	<dl>
		<dt>Логін:</dt>
		<dd><input required="required" name="login" size="16" type="text" placeholder="Логін" ></dd>
		<dt>Пароль:</dt>
		<dd><input required="required" name="password" size="16" type="password" placeholder="Пароль" ></dd>
		<dt><a href="/auth.php">Зареєструватися</a></dt>
		<dd><a href="/auth.php">Забули пароль?</a></dd>
	</dl>
	<div><input type="submit" value=" Ok "></div>
</form>
<?
	}
	else{
		include('parts/tool-bar.php');
	}
?>
