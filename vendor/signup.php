<?php

		session_start();
		require_once 'connect.php';
		

		$name =  htmlspecialchars(trim($_POST['name']));
		$phone = htmlspecialchars(trim($_POST['phone']));
		$email = filter_var(htmlspecialchars(trim($_POST['email'])), FILTER_VALIDATE_EMAIL);
		$password = htmlspecialchars(trim($_POST['password']));
		$password_confirm = htmlspecialchars(trim($_POST['password_confirm']));

		$phone = preg_replace("/[^0-9]/", '', $phone);
		if($phone[0] == '7'){
			$phone[0] = '8';
		}

		

		$check_unic_name = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM `users` WHERE `name` = '$name'"));
		$check_unic_phone = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM `users` WHERE `phone` = '$phone'"));
		$check_unic_email = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$email'"));
		$checker = $check_unic_name + $check_unic_phone + $check_unic_email;

		if($check_unic_name > 0) {
			$_SESSION['massage_name'] = 'Пользователь с таким именем существует';	
			header('Location: ../registration.php');
		}

		if($check_unic_phone > 0){
			$_SESSION['massage_phone'] = 'Пользователь с таким номером телефона существует';	
			header('Location: ../registration.php');
		}

		if($check_unic_email > 0){
			$_SESSION['massage_email'] = 'Пользователь с таким адресом эл. почты существует';	
			header('Location: ../registration.php');
		}

		if ($password != $password_confirm){
			$_SESSION['massage'] = 'Пароли не совподают';	
			header('Location: ../registration.php');
		}


		if (($password === $password_confirm) and ($checker == 0)) {

			$password = md5($password);
			
			mysqli_query($connect, "INSERT INTO `users` (`name`, `phone`, `email`, `password`) VALUES ('$name', '$phone', '$email', '$password')");
			
			$_SESSION['massage'] = 'Регистрация прошла успешно';	
			header('Location: ../index.php');
		}

?>		