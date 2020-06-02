<?php
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/loginPage.php');?>
<html><div class="wrapper">
	<head>
		<title>Карта сайта</title>
		<link rel="stylesheet" type="text/css" href="/css/index.css">
		<meta charset="utf-8">
	</head>
	<style>
		a{
			color: inherit;
		}
		li{
			margin-top: 5px;
		}
	</style>
<div>	
	<!--        HEADER          -->
	<?php include($_SERVER['DOCUMENT_ROOT'].'/templates/header.php'); ?>
	<body>
		<div class="path mediumTextBlue"><span><a href="/">Главная</a> • <a href="/map.php">Карта сайта</a></span></div>
		<div id="aboutContent" class="content mediumTextBlack">
			<div class="veryLargeTextBlack">Карта сайта</div>
			<div class="polosaGray"><div></div></div>

			<ul>
				<li><a href="/">Главная</a></li>
				<li><a href="/registration.php">Регистрация</a></li>
				<li><a href="/about">О поликлинике</a></li>
				<li><a href="/about/administration.php">Администрация</a></li>
				<li><a href="/about/specialisten.php">Специалисты</a></li>
				<li><a href="/about/raspisanie.php">Расписание врачей</a></li>
				<li><a href="/pacient">Пациентам</a></li>
				<li><a href="/pacient/news.php">Новости</a></li>
				<li><a href="/pacient/zapis.php">Запись на прием</a></li>
				<li><a href="/contacts">Контакты</a></li>
				<li><a href="/contacts/comments.php">Отзывы</a></li>
				<li><a href="/profile">Личный кабинет</a></li>
				<li><a href="/map.php">Карта сайта</a></li>
			</ul>

		</div>
</body>
	
</div>
	<!--        FOOTER          -->
	<?PHP include($_SERVER['DOCUMENT_ROOT'].'/templates/footer.php'); ?>
</div></html>