<?php
	session_start();
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/db/db.php');
	$mysqli = new mysqli($hostDB, $userDB, $passwordDB, $database);
	$adminOption = false;
	if(isset($_SESSION['user_card']) && $mysqli->query('SELECT RankNumber FROM Doctors WHERE Card = '.$_SESSION['user_card'])->fetch_assoc()['RankNumber'] == 10){
		$adminOption = true;
	}
?>