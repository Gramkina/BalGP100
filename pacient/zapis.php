<?php
    require($_SERVER['DOCUMENT_ROOT'].'/php/loginPage.php');
?>

<html><div class="wrapper">
	<head>
		<title>Пациентам - Запись на прием</title>
		<link rel="stylesheet" type="text/css" href="css/pacient.css">
		<meta charset="utf-8">
	</head>
	
<div>	
	<!--        HEADER          -->
	<?php include($_SERVER['DOCUMENT_ROOT'].'/templates/header.php'); ?>

	<body>
		<div class="path mediumTextBlue"><span><a href="/">Главная</a> • <a href="/pacient">Пациентам</a> • <a href="/pacient/zapis.php">Запись на прием</a></span></div>
		<div class="content">
			<div class="veryLargeTextBlack nazvanie">Запись на прием</div>
			<div class="polosaGray"><div></div></div>

			<div class="mainDiv">
			<?php if(isset($_SESSION['user_card'])){ 
				if(isset($_GET['Doctor'])){
					require_once($_SERVER['DOCUMENT_ROOT'].'/php/db/db.php');
					$mysqli = new mysqli($hostDB, $userDB, $passwordDB, $database);
					$stmt = $mysqli->prepare('SELECT * FROM Doctors WHERE Card = ?');
					$stmt->bind_param('i', $_GET['Doctor']);
					$stmt->execute();
					if($doctors = $stmt->get_result()->fetch_assoc()){
						$users = $mysqli->query('SELECT Fam, Imya, Otch FROM Users WHERE Card = '.$_GET['Doctor'])->fetch_assoc();
						require_once('templates/GETZapisi.php');
					} 
					else require_once('templates/defaultZapisi.php');
				}
				else require_once('templates/defaultZapisi.php');
			}
			else{ ?>
				<div class="errorDiv">
					<img src="/image/sadSmile.svg">
					<div class="largeTextBlack">Данная страница доступна только <label onclick="$('#SignButtonOpen').prop('checked', 'true')" class="avtorizationURL">авторизированным</label> пользователям</div>
				</div>
			<?php } ?>
			</div>
		</div>
	</body>
</div>

	<!--        FOOTER          -->
	<?PHP include($_SERVER['DOCUMENT_ROOT'].'/templates/footer.php'); ?>
</div></html>