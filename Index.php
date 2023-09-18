<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Авторизация и регистрация</title>
	<script src="https://smartcaptcha.yandexcloud.net/captcha.js" defer></script>
	<link rel="stylesheet" type="text/css" href="style.css" >
</head>



<body>
	<form action="vendor/signin.php" method="post">
		
		<label>Эл. почта или телефон</label>
		<input type="text" name="login">
		<label>Пароль</label>
		<input type="password" name="password">			
		<button type="submit">Войти</button>
		<p>
			У вас нет  аккаунта? - <a href="/registration.php">Регистрация</a>
		</p>
		<?php
			if(isset($_SESSION['massage'])){
				echo  '<p class="msg">' .$_SESSION['massage']. '</p>';
			}			 
			 unset($_SESSION['massage']); 
		?>
		
		
	</form>
	<div
  class="smart-captcha"
  data-sitekey="<Ключ_клиентской_части>"
  data-hl="ru"> </div>
	</body>
</html>