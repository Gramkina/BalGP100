<?php
	session_start();
	unset($_SESSION['user_card']);
	unset($_SESSION['ip']);

	if(isset($_COOKIE['token']) && isset($_COOKIE['series'])){
		include($_SERVER['DOCUMENT_ROOT'].'/php/db/db.php');
		$mysqli = new mysqli($hostDB, $userDB, $passwordDB, $database);
		$stmt = $mysqli->prepare('DELETE FROM tokens WHERE token = ? and series = ?');
		$stmt->bind_param('ss', $_COOKIE['token'], $_COOKIE['series']);
		$stmt->execute();
	}
	unset($_COOKIE['token']);
	setcookie('token', '', -1, '/');
	unset($_COOKIE['series']);
	setcookie('series', '', -1, '/');
?>