<?php
	$password = $_POST['password'];
	$passwordE = $_POST['passwordE'];
	$email = $_POST['email'];
	$fam = $_POST['fam'];
	$imya = $_POST['imya'];
	$otch = $_POST['otch'];
	$phone = $_POST['phone'];
	$politik = $_POST['politik'];
	$birthday = $_POST['birthday'];
	$gender = $_POST['gender'];
	if(preg_match('/^[a-zA-Z\d]{6,30}$/', $password) && !strcmp($password, $passwordE) && strlen($email) != null && preg_match('/.+?\@.+/', $email) && strlen($fam) >= 3 && strlen($imya) >= 3 && preg_match('/^[\+*7]{2}\d{10}$|^[8]\d{10}$/', $phone) && !strcmp($politik, 'on') && $birthday != null && strtotime($birthday) < strtotime(date("m.d.y")) && ($gender == 1 || $gender == 0)){
		include('../../php/db/db.php');
		$mysql = new mysqli($hostDB, $userDB, $passwordDB, $database);
		$stmt = $mysql->prepare('SELECT * FROM vr_reg WHERE Email = ?');
		$stmt->bind_Param("s", $email);
		$stmt->execute();
		if($stmt->get_result()->fetch_assoc() == 0){
			$stmt = $mysql->prepare('SELECT * FROM Users WHERE Email = ?');
			$stmt->bind_Param("s", $email);
			$stmt->execute();
			if($stmt->get_result()->fetch_assoc() == 0){
				$code;
				do{
					$code = bin2hex(random_bytes(18));
				}while($mysql->query('SELECT * FROM vr_reg WHERE code = "'.$code.'"')->fetch_assoc() != 0);
				$stmt = $mysql->prepare('INSERT INTO vr_reg(Password, Email, Fam, Imya, Otch, Phone, time, code, Gender, Date) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
				$stmt->bind_Param("ssssssisis", $password = password_hash($password, PASSWORD_BCRYPT), $email, $fam, $imya, $otch, $phone, $time = (time()+60*20), $code, $gender, $birthday);
				$stmt->execute();
				require_once($_SERVER['DOCUMENT_ROOT'].'/php/sendMail.php');
				if(sendMail($email, $imya, 'Регистрация', 'Уважаемый, '.$fam.' '.$imya.', для того, чтобы подтвердить регистрацию необходимо перейти по ссылке https://balgp100.pp.ua/registration.php?code='.$code.'. Если вы не регистрировались на сайте, то проигнорируйте данное письмо.', 'Уважаемый, '.$fam.' '.$imya.', для того, чтобы подтвердить регистрацию необходимо перейти по ссылке https://balgp100.pp.ua/registration.php?code='.$code.'. Если вы не регистрировались на сайте, то проигнорируйте данное письмо.')){
					echo 2;
				}
			}
			else echo 1;
		}
		else echo 1;
		$mysql->close();
	}
	else echo 'Ошибка при заполнении полей.';
?>