<?php

session_start();
require_once 'connect.php';


$name =  htmlspecialchars(trim($_POST['name']));
$phone = htmlspecialchars(trim($_POST['phone']));
$email = filter_var(htmlspecialchars(trim($_POST['email'])), FILTER_VALIDATE_EMAIL);
$password = md5(htmlspecialchars(trim($_POST['password'])));
$password_new = htmlspecialchars(trim($_POST['password_new']));
$password_confirm = htmlspecialchars(trim($_POST['password_confirm']));

$user_id = $_SESSION['user']['id'];
$old_name = $_SESSION['user']['name'];
$old_phone = $_SESSION['user']['phone'];
$old_email = $_SESSION['user']['email']; 

$phone = preg_replace("/[^0-9]/", '', $phone);
if($phone[0] == '7'){
	$phone[0] = '8';
}



$check_unic_name = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM `users` WHERE `name` = '$name'"));
$check_unic_phone = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM `users` WHERE `phone` = '$phone'"));
$check_unic_email = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$email'"));
$check_user_password = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM `users` WHERE `id` = '$user_id' AND `password` = '$password'"));

$checker = $check_unic_name + $check_unic_phone + $check_unic_email;

// if($check_unic_name > 0) {
// 	$_SESSION['massage_name_1'] = 'Пользователь с таким именем существует';	
// 	header('Location: ../registration.php');
// }

// if($check_unic_phone > 0){
// 	$_SESSION['massage_phone'] = 'Пользователь с таким номером телефона существует';	
// 	header('Location: ../registration.php');
// }

// if($check_unic_email > 0){
// 	$_SESSION['massage_email'] = 'Пользователь с таким адресом эл. почты существует';	
// 	header('Location: ../registration.php');
// }

// if ($password != $password_confirm){
// 	$_SESSION['massage'] = 'Пароли не совподают';	
// 	header('Location: ../registration.php');
// }




if (($password_new === $password_confirm) and ($check_user_password > 0))  {

	if(!empty($name) and ($check_unic_name == 0)){
		mysqli_query($connect, "UPDATE `users` SET `name` = '$name' WHERE `users`.`id` = '$user_id'");
	}elseif(!empty($name)){
		$_SESSION['massage_name'] = 'Пользователь с таким именем существует';	
		header('Location: ../profile.php');
	}

	if(!empty($email) and ($check_unic_email == 0)){
		mysqli_query($connect, "UPDATE `users` SET `email` = '$email' WHERE `users`.`id` = '$user_id'");
	}elseif(!empty($email)){
		$_SESSION['massage_email'] = 'Пользователь с таким адресом эл. почты существует';	
		header('Location: ../profile.php');
	}

	if(!empty($phone) and ($check_unic_phone == 0)){
		mysqli_query($connect, "UPDATE `users` SET `phone` = '$phone' WHERE `users`.`id` = '$user_id'");
	}elseif(!empty($phone)){
		$_SESSION['massage_phone'] = 'Пользователь с таким номером телефона существует';	
		header('Location: ../profile.php');
	}

	if(!empty($password_new) and ($password != $password_confirm)){
		$password_new = md5($password_new);
		mysqli_query($connect, "UPDATE `users` SET `password` = '$password_new' WHERE `users`.`id` = '$user_id'");
	}elseif(!empty($password_new)){
		$_SESSION['massage'] = 'Пароли не совподают';	
	header('Location: ../profile.php');
	}

	$check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `id` = '$user_id'");

	$user = mysqli_fetch_assoc($check_user);
			
			$_SESSION['user'] = [
				"id" => $user['id'],
				"name" => $user['name'],
				"phone" => $user['phone'],
				"email" => $user['email']
			];

	
	$_SESSION['massage'] = 'Изменения прошли успешно';	
	header('Location: ../profile.php');

$name =  null;
$phone = null;
$email = null;
$password = null;
$password_new = null;
$password_confirm = null;
}

?>		