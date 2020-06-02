<?php
    $fam = $_POST['fam'];
	$imya = $_POST['imya'];
	$otch = $_POST['otch'];
	$phone = $_POST['phone'];
	$birthday = $_POST['birthday'];
    $gender = $_POST['gender'];
	if(strlen($fam) >= 3 && strlen($imya) >= 3 && preg_match('/^[\+*7]{2}\d{10}$|^[8]\d{10}$/', $phone) && $birthday != null && strtotime($birthday) < strtotime(date("m.d.y")) && ($gender == 1 || $gender == 0)){
        session_start();
        if(isset($_SESSION['user_card'])){
            include($_SERVER['DOCUMENT_ROOT'].'/php/db/db.php');
            $mysql = new mysqli($hostDB, $userDB, $passwordDB, $database) or die(2);
            $stmt = $mysql->prepare('UPDATE Users SET Fam = ?, Imya = ?, Otch = ?, Phone = ?, Gender = ?, Date = ? WHERE Card = '.$_SESSION['user_card']) or die(2);
            $stmt->bind_Param("ssssis", $fam, $imya, $otch, $phone, $gender, $birthday) or die(2);
            $stmt->execute() or die(2);
            echo 3;
            $mysql->close();
        }
        else echo 1;
	}
	else echo 0;
?>