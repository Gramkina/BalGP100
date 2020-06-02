<?php include($_SERVER['DOCUMENT_ROOT'].'/php/loginPage.php');
	if(!isset($_SESSION['user_card']))
		header('Location: /index.php');
?>

<html>
	<head>
		<title>Личный кабинет</title>
		<link rel="stylesheet" type="text/css" href="css/profile.css">
		<meta charset="utf-8">
	</head>
	
	<!--        HEADER          -->
	<?php include($_SERVER['DOCUMENT_ROOT'].'/templates/header.php'); ?>
	<!--         PATH           -->
	<div class="path mediumTextBlue"><span><a href="/">Главная</a> • <a href="/profile">Личный кабинет</a></span></div>

	<!-------------------------------------------------------------------->
	
	<div style="max-width: 1100px; margin:auto; display:flex; justify-content: space-between; overflow:hidden; padding: 0 4px 4px; margin-top: 15px;">
		<div style="background-color:#F2F2F2; width:100%; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
			<div class="largeTextWhite zagolovokLK">Личный кабинет</div>

			<div class="mainDiv">

				<!-- 		MENU   	    -->
				<?php include_once('templates/menu.php'); ?>

				
				<div class="nextContent hiddenClass"><img src="/gif/loading.gif" style="width:260px; height:195px"></div>
				<div class="contentDefault">
					<div class="mainContentProfileUp">
						<div href="changeprofile" class="mainMenuProfileElement">
							<div class="mainMenuProfileElementCircle">
								<img src="/icons/wrechIcon.svg">
							</div>
							<div class="mainMenuProfileElementText largeTextBlack">Редактировать данные</div>
						</div>
						
						<div href="devices" class="mainMenuProfileElement">
							<div class="mainMenuProfileElementCircle">
								<img src="/icons/myDevicesIcon.svg">
							</div>
							<div class="mainMenuProfileElementText largeTextBlack">Мои устройства</div>
						</div>

						<div href="changepassword" class="mainMenuProfileElement">
							<div class="mainMenuProfileElementCircle">
								<img src="/icons/changePasswordIcon.svg">
							</div>
							<div class="mainMenuProfileElementText largeTextBlack">Сменить пароль</div>
						</div>

						<div href="zapisi" class="mainMenuProfileElement">
							<div class="mainMenuProfileElementCircle">
								<img src="/icons/list_icon.svg">
							</div>
							<div class="mainMenuProfileElementText largeTextBlack">Записи на прием</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
	
	<!-------------------------------------------------------------------->

	<!--        FOOTER          -->
	<?php include($_SERVER['DOCUMENT_ROOT'].'/templates/footer.php'); ?>

</html>

<script src='js/loadPage.js'></script>
<script src='js/animationLoadPageIndex.js'></script>