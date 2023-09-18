<?php
		session_start();
		require_once 'connect.php';		
		
		$login = htmlspecialchars(trim($_POST['login']));		
		$password = md5(htmlspecialchars(trim($_POST['password'])));
		$check_user;

		if(filter_var($login, FILTER_VALIDATE_EMAIL) != false){
			$check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$login' AND `password` = '$password'");		
		} else {
			$login = preg_replace("/[^0-9]/", '', $login);
			if(($login[0] == '7') and (strlen($str) == 11)){
				$login[0] = '8';
			}
			$check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `phone` = '$login' AND `password` = '$password'");
		}

		if (mysqli_num_rows($check_user) > 0){
			$user = mysqli_fetch_assoc($check_user);
			
			$_SESSION['user'] = [
				"id" => $user['id'],
				"name" => $user['name'],
				"phone" => $user['phone'],
				"email" => $user['email']
			];
			header('Location: ../profile.php');

		}else{
			$_SESSION['massage'] = 'Не верный логин или пароль';	
			header('Location: ../index.php');
		}

		

		
		