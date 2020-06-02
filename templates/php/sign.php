<?php
	session_start();
	include($_SERVER['DOCUMENT_ROOT'].'/php/db/db.php');
	
	$email = $_POST['email'];
	$password = $_POST['password'];
	$remember = $_POST['remember'];

	$mysqli = new mysqli($hostDB, $userDB, $passwordDB, $database) or die("Не удалось подключться к БД");
	
	$stmt = $mysqli->prepare('SELECT * FROM Users WHERE Email = ?');
	$stmt->bind_param("s", $email);
	$stmt->execute();
	if(($array = $stmt->get_result()->fetch_assoc()) != null && password_verify($password, $array['Password'])){
		$_SESSION['user_card'] = $array['Card'];
		if($remember == 'on'){
			$token;
			do{
				$token = bin2hex(random_bytes(10));
			}while($mysqli->query('SELECT * FROM tokens WHERE token = "'.$token.'"')->fetch_assoc() != 0);
			$series = bin2hex(random_bytes(16));
			$stmt = $mysqli->prepare('INSERT INTO tokens(token, series, seriesTime, time, Card, user_agent, IP) VALUES(?, ?, ?, ?, ?, ?, ?)') or die(0);
			$stmt->bind_param("ssiiiss", $token, $series, $seriesTime = time()+(60*15), $time = time()+(60*60*24*7), $_SESSION['user_card'], $_SERVER['HTTP_USER_AGENT'], $_SERVER['REMOTE_ADDR']) or die(0);
			$stmt->execute() or die(0);
			setcookie('token', $token, time()+(60*60*24*7), '/');
			setcookie('series', $series, time()+(60*60*24*7), '/');
		}
		else $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
		echo 1;
	}
	else echo 0;

	$mysqli->close();
?>