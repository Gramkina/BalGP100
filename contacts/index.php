<?php
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/loginPage.php');?>
<html><div class="wrapper">
	<head>
		<title>Контакты</title>
		<link rel="stylesheet" type="text/css" href="css/contacts.css">
		<meta charset="utf-8">
	</head>
<div>	
	<!--        HEADER          -->
	<?php include($_SERVER['DOCUMENT_ROOT'].'/templates/header.php'); ?>
	<body>
		<div class="path mediumTextBlue"><span><a href="/">Главная</a> • <a href="/pacient">Контакты</a></span></div>
		<div id="aboutContent" class="content mediumTextBlack">
			<div class="veryLargeTextBlack">Контакты</div>
			<div class="polosaGray"><div></div></div>
			<div class="divContact">
				<div>
					<div><font class="mediumTextBlack">Адрес:</font><font id="adress">435632 г.Балаково ул.Гагарина 45</font></div><br>
					<div><font class="mediumTextBlack">Часы работы:</font><br><font id="adress">ПН-ПТ - 8:30-20:30</font><br><font id="adress">ПН-ПТ - НЕ РАБОТАЕТ</font></div><br>
				</div>
				<div>Телефоны:
					<div><font class="mediumTextBlack">Справочная:</font><font id="adress">+79046532554</font></div><br>
					<div><font class="mediumTextBlack">Вызов врача на дом:</font><font id="adress">+79046337244</font></div><br>
					<div><font class="mediumTextBlack">Неотложная помощь:</font><font id="adress">112 или 103</font></div><br>
				</div>
			</div>
		</div>
	</body>
	
</div>
	<!--        FOOTER          -->
	<?PHP include($_SERVER['DOCUMENT_ROOT'].'/templates/footer.php'); ?>
</div></html>