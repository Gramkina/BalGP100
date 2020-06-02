<?php include($_SERVER['DOCUMENT_ROOT'].'/php/loginPage.php');
	if(!isset($_SESSION['user_card']))
		header('Location: /index.php');
?>

<html>
	<head>
		<title>Личный кабинет - Смена пароля</title>
		<link rel="stylesheet" type="text/css" href="css/profile.css">
		<meta charset="utf-8">
	</head>
	
	<!--        HEADER          -->
	<?php include($_SERVER['DOCUMENT_ROOT'].'/templates/header.php'); ?>
	<!--         PATH           -->
	<div class="path mediumTextBlue"><span><a href="/">Главная</a> • <a href="/profile">Личный кабинет</a> • <a href="/profile/changepassword.php">Смена пароля</a></span></div>

	<!-------------------------------------------------------------------->
	
	<div style="max-width: 1100px; margin:auto; display:flex; justify-content: space-between; overflow:hidden; padding: 0 4px 4px; margin-top: 15px;">
		<div style="background-color:#F2F2F2; width:100%; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);">
			<div class="largeTextWhite zagolovokLK">Личный кабинет</div>

			<div class="mainDiv disFlex">

				<!-- 		MENU   	    -->
				<?php include_once('templates/menu.php'); ?>

				<div class="nextContent "><img src="/gif/loading.gif" style="width:260px; height:195px"></div>
				
			</div>

		</div>
	</div>
	
	<!-------------------------------------------------------------------->

	<!--        FOOTER          -->
	<?php include($_SERVER['DOCUMENT_ROOT'].'/templates/footer.php'); ?>

</html>

<script src='js/loadPage.js'></script>
<script>
    window.onload = function(){
		cod = (window.location.href.split('?').length == 2) ? window.location.href.split('?')[1].split('&')[0].split('=') : null;
		$.get('templates/changepassword.php', (cod != null && cod[0] == 'code') ? {code:cod[1]} : '', function(result){
			$(".nextContent").toggleClass("hiddenClass");
			$('.mainDiv').append(result);
		});
	}
</script>