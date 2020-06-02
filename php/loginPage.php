<?php
	session_start();
	use phpbrowscap\Browscap;
	if(isset($_COOKIE['token']) && isset($_COOKIE['series'])){
		require_once($_SERVER['DOCUMENT_ROOT'].'/php/db/db.php');
		$mysqli = new mysqli($hostDB, $userDB, $passwordDB, $database);
		$stmt = $mysqli->prepare('SELECT * FROM tokens WHERE token = ?');
		$stmt->bind_param("s", $_COOKIE['token']);
		$stmt->execute();
		$result = $stmt->get_result()->fetch_assoc();
		if($result != null){
			if($result['series'] == $_COOKIE['series']){
				require_once($_SERVER['DOCUMENT_ROOT'].'/library/php/Browscap.php');
				$bb = new Browscap('');
				if($result['user_agent'] == $_SERVER['HTTP_USER_AGENT'] || ($result['IP'] == $_SERVER['REMOTE_ADDR']) && $bb->getBrowser($result['user_agent'], true)['Browser'] == $bb->getBrowser(null, true)['Browser']){
					$stmt = $mysqli->prepare('SELECT * FROM Users WHERE Card = ?');
					$stmt->bind_Param("i", $result['Card']);
					$stmt->execute();
					$array = $stmt->get_result()->fetch_assoc();
					if($result['user_agent'] != $_SERVER['HTTP_USER_AGENT'] || $result['IP'] != $_SERVER['REMOTE_ADDR']){
						$stmt = $mysqli->prepare('UPDATE tokens SET time = ?, user_agent = ?, IP = ? WHERE token = ?');
						$stmt->bind_param("isss", $time = time()+(60*60*24*7), $_SERVER['HTTP_USER_AGENT'], $_SERVER['REMOTE_ADDR'], $_COOKIE['token']);
						$stmt->execute();
					}
					if($result['seriesTime'] < time()){
						$series = bin2hex(random_bytes(16));
						$stmt = $mysqli->prepare('UPDATE tokens SET series = ?, seriesTime = ? WHERE token = ?') or die(2);
						$stmt->bind_param("sis", $series, $time = time()+(60*15), $_COOKIE['token']) or die(2);
						$stmt->execute() or die(2);
						setcookie('series', $series, time()+(60*60*24*7), '/');
					}
					$stmt = $mysqli->prepare('UPDATE tokens SET time = ? WHERE token = ?');
					$stmt->bind_param("is", $time = time()+(60*60*24*7), $_COOKIE['token']);
					$stmt->execute();
					setcookie('token', $_COOKIE['token'], time()+(60*60*24*7), '/');
					$_SESSION['user_card'] = $array['Card'];
				}
				else{
					deleteToken($mysqli);
					deleteData();
				}
			}
			else{
				deleteToken($mysqli);
				deleteData();
			}
		}
		else deleteData();
		$mysqli->close();
	}
	else if(isset($_SESSION['user_card']) && isset($_SESSION['ip'])){
		if($_SERVER['REMOTE_ADDR'] == $_SESSION['ip']){
			include($_SERVER['DOCUMENT_ROOT'].'/php/db/db.php');
			$mysql = new mysqli($hostDB, $userDB, $passwordDB, $database);
			$stmt = $mysql->prepare('SELECT * FROM Users WHERE Card = ?');
			$stmt->bind_Param("i", $_SESSION['user_card']);
			$stmt->execute();
			$array = $stmt->get_result()->fetch_assoc();
			$mysql->close();
		}
		else{
			unset($_SESSION['user_card']);
			unset($_SESSION['ip']);
		}
	}
	else deleteData();

	function deleteToken($mysqli){
		$stmt = $mysqli->prepare('DELETE FROM tokens WHERE token = ?');
		$stmt->bind_param("s", $_COOKIE['token']);
		$stmt->execute();
	}

	function deleteData(){
		unset($_COOKIE['token']);
		setcookie('token', '', -1, '/');
		unset($_COOKIE['series']);
		setcookie('series', '', -1, '/');
		unset($_SESSION['user_card']);
		unset($_SESSION['ip']);
	}
?>