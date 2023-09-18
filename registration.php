
<?php
		session_start()
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Авторизация и регистрация</title>
	<script src="vendor/phoneMasck.js"></script>
	<link rel="stylesheet" type="text/css" href="style.css" >
</head>



<body>
	<form action="vendor/signup.php" method="post">
		<label>Имя</label>
		<input type="text" name="name" required>
		
		<?php
			if(isset($_SESSION['massage_name'])){
				echo  '<p class="msg">' .$_SESSION['massage_name']. '</p>';;
			}			 
			 unset($_SESSION['massage_name']); 
			 ?>
		
		<label>Телефон</label>
		<input  type="tel" data-tel-input  name="phone" required>
		
		<?php
			if(isset($_SESSION['massage_phone'])){
				echo  '<p class="msg">' .$_SESSION['massage_phone']. '</p>';;
			}			 
			 unset($_SESSION['massage_phone']); 
			 ?>
		
		<label>Эл. почта</label>
		<input type="email" name="email" required>
		
		<?php
			if(isset($_SESSION['massage_email'])){
				echo  '<p class="msg">' .$_SESSION['massage_email']. '</p>';
			}			 
			 unset($_SESSION['massage_email']); 
			 ?>
		
		<label>Пароль</label>
		<input type="password" name="password" required>
		<label>Повторите пароль</label>
		<input type="password" name="password_confirm" required>
		<button type="submit">Зарегистрироваться</button>
		<p>
			У вас есть  аккаунт? - <a href="/">Авторизация</a>
		</p>
		
			<?php
			if(isset($_SESSION['massage'])){
				echo  '<p class="msg">' .$_SESSION['massage']. '</p>';
			}			 
			 unset($_SESSION['massage']); 
			 ?>
		
		
	</form>
	
</body>
</html>