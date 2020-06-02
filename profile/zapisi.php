<?php include($_SERVER['DOCUMENT_ROOT'].'/php/loginPage.php');
	if(!isset($_SESSION['user_card']))
		header('Location: /index.php');
?>

<html>
	<head>
		<title>Личный кабинет - Записи на прием</title>
		<link rel="stylesheet" type="text/css" href="css/profile.css">
		<meta charset="utf-8">
	</head>
	
	<!--        HEADER          -->
	<?php include($_SERVER['DOCUMENT_ROOT'].'/templates/header.php'); ?>
	<!--         PATH           -->
	<div class="path mediumTextBlue"><span><a href="/">Главная</a> • <a href="/profile">Личный кабинет</a> • <a href="/profile/zapisi.php">Записи на прием</a></span></div>

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
		$.get('templates/zapisi.php', function(result){
			$(".nextContent").toggleClass("hiddenClass");
			$('.mainDiv').append(result);
		});
	}
</script>