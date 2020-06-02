<?php
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/loginPage.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/adminLogin.php');	
?>
<html><div class="wrapper">
	<head>
		<title>О поликлинике</title>
		<link rel="stylesheet" type="text/css" href="css/about.css">
		<meta charset="utf-8">
	</head>
	
<div>	
	<!--        HEADER          -->
	<?php include($_SERVER['DOCUMENT_ROOT'].'/templates/header.php'); ?>

	<?php 
	if($_GET['Doctor']){
		require_once($_SERVER['DOCUMENT_ROOT'].'/php/db/db.php');
		$mysqli = new mysqli($hostDB, $userDB, $passwordDB, $database);
		$stmt = $mysqli->prepare('SELECT Rank FROM Doctors WHERE Card = ? AND (RankNumber = 1 OR RankNumber = 3)');
		$stmt->bind_param('i', $_GET['Doctor']);
		$stmt->execute();
		if($doctor = $stmt->get_result()->fetch_assoc()){
			$users = $mysqli->query('SELECT Fam, Imya, Otch, Avatar FROM Users WHERE Card = '.$_GET['Doctor'])->fetch_assoc(); ?>
			<div class="path mediumTextBlue"><span><a href="/">Главная</a> • <a href="/about">О поликлинике</a> • <a href="/about/aboutDoctor.php?Doctor=<?php echo $_GET['Doctor']; ?>"><?php echo $users['Fam'].' '.$users['Imya'].' '.$users['Otch']; ?></a></span></div>
			<div class='content'>
				<div class="veryLargeTextBlack"><?php echo $users['Fam'].' '.$users['Imya'].' '.$users['Otch']; ?></div>
				<div class="polosaGray"><div></div></div>
				<div class="aboutDoctorDivInfo">
					<img src="/avatarUsers/<?php echo $users['Avatar'] ? $users['Avatar'] : 'noAvatar.svg'; ?>">
					<div class="mediumTextBlack infoDoctorAboutDoctor">
						<?php include('aboutDoctor//'.$_GET['Doctor']); ?>
					</div>
				</div>
			</div>

			<?php 
			if($adminOption){ ?>

				<script>
					$('.infoDoctorAboutDoctor').dblclick(function(){
						$.post('php/getContentDoctorInfo.php', {Doctor: <?php echo $_GET['Doctor']; ?>}, function(result){
							$('.infoDoctorAboutDoctor').empty().append('<textarea id="contentInfo" autofocus>'+result+'</textarea><input id="saveInfo" type="button" value="Сохранить">');
						});
					})
					$('body').on('click', '#saveInfo', function(){
						$.post('php/saveContentDoctorInfo.php', {Doctor: <?php echo $_GET['Doctor']; ?>, Content: $('#contentInfo').val()}, function(result){
							location.href = location.href;
						});
					});
				</script>

			<?php
			}
		}
	}
	else echo 'Ошибка';
	?>
</div>
	<!--        FOOTER          -->
	<?PHP include($_SERVER['DOCUMENT_ROOT'].'/templates/footer.php'); ?>
</div></html>