<?php
session_start();
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

	<form action="vendor/update.php" method="post">
		<h2>ВашеИМЯ: <?php echo $_SESSION['user']['name'] ?></h2>
		<label>Ведите для изменения:</label>
		<input type="text" name="name">

		<?php
			if(isset($_SESSION['massage_name'])){
				echo  '<p class="msg">' .$_SESSION['massage_name']. '</p>';
			}			 
			 unset($_SESSION['massage_name']); 
		?>		
		
		<h2>Ваше № телефона: <?= $_SESSION['user']['phone'] ?></h2>
		<label>Ведите для изменения:</label>
		<input  type="tel" data-tel-input  name="phone">

		<?php
			if(isset($_SESSION['massage_phone'])){
				echo  '<p class="msg">' .$_SESSION['massage_phone']. '</p>';;
			}			 
			 unset($_SESSION['massage_phone']); 
		?>
		
		
		
		<h2>Ваше адре эл. рочты: <?= $_SESSION['user']['email'] ?></h2>
		<label>Ведите для изменения:</label>
		<input type="email" name="email">

		<?php
			if(isset($_SESSION['massage_email'])){
				echo  '<p class="msg">' .$_SESSION['massage_email']. '</p>';
			}			 
			 unset($_SESSION['massage_email']); 
		?>
		
		
		
		



		<label>Изменить Пароль</label>
		<input type="password" name="password_new" >
		<label>Повторите пароль</label>
		<input type="password" name="password_confirm" >
		<br>
		<label>Пароль</label>
		<input type="password" name="password" required>

		<?php
			if(isset($_SESSION['massage_old_pass'])){
				echo  '<p class="msg">' .$_SESSION['massage_old_pass']. '</p>';
			}			 
			 unset($_SESSION['massage_old_pass']); 
		?>
		<button type="submit">Изменить</button>
		<p>
			<a href="vendor/logout.php">Выход</a>
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