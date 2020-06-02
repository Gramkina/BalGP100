<?php 
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/loginPage.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/adminLogin.php');
?>
<html><div class="wrapper">
	<head>
		<title>О поликлинике - Администрация</title>
		<link rel="stylesheet" type="text/css" href="css/about.css">
		<meta charset="utf-8">
	</head>
<div>	
	<!--        HEADER          -->
	<?php include($_SERVER['DOCUMENT_ROOT'].'/templates/header.php'); ?>

	<body>
		<div class="path mediumTextBlue"><span><a href="/">Главная</a> • <a href="/about">О поликлинике</a> • <a href="/about/administration.php">Администрация</a></span></div>
		<div class='content'>
			<div class="veryLargeTextBlack">Администрация</div>
			<div class="polosaGray"><div></div></div>
			<div class='infoAdmin'>
				<?php
				require_once($_SERVER['DOCUMENT_ROOT'].'/php/db/db.php');
				$mysqli = new mysqli($hostDB, $userDB, $passwordDB, $database);
				$result = $mysqli->query('SELECT * FROM Doctors WHERE RankNumber = 1');
				while($arr = $result->fetch_assoc()){ 
					$arr1 = $mysqli->query('SELECT Avatar, Fam, Imya, Otch FROM Users WHERE Card = '.$arr['Card'])->fetch_assoc(); 
					//------------------------------------------?>
					<div class="mainBlockDivUser">
						<a href="aboutDoctor.php?Doctor=<?php echo $arr['Card']; ?>"><img src="/avatarUsers/<?php echo ($arr1['Avatar'] != null ? $arr1['Avatar'] : 'noAvatar.svg'); ?>"></a>
						<div class="mediumTextBlack"><?php echo $arr1['Fam'].' '.$arr1['Imya'].' '.$arr1['Otch']; ?></div>
						<div class="smallTextBlue"><?php echo $arr['Rank']; ?></div>
						<div class="mediumTextBlue buttonZapis"><a href="/pacient/zapis.php?Doctor=<?php echo $arr['Card']; ?>">Записаться</a></div>
					</div>	
				<?php //-----------------------------------------
				}
				if($adminOption){
					//--------------------------------------------?>
					<div class='mainBlockDiv' href="#addDoctor">
						<img src="/icons/addPlus.svg">
						<div class="largeTextGreen">Добавить</div>
					</div>	
				<?php //-----------------------------------------
				} ?>
			</div>
			<?php //----------------------------
			if($adminOption){ 
				//-----------------------------------?>
				<div class="addDoctorContent invisibleObject" id="addDoctor">
					<div class="largeTextBlue">Добавить врача</div>
					<div class="findUser">
						<div class="fullInputBlockReg">
							<div class="inputBlockReg">
								<div class="inputBlockRegistration">
									<div class="iconInputBlockReg">
										<img src="/icons/stethoscope.svg">
									</div>
									<input name="card" id="card" class="inputInputBlockReg" type="text" placeholder="Номер карты">
								</div>
							</div>
						</div>
						<input id="findUserBut" type="button" class="buttonFindUser mediumTextBlack" value="Найти">
					</div>
					<div style="margin-top: 5px;" id="findUserResult"></div>
				</div>
				<script>
					$('.mainBlockDiv').click(function(){
						$('.addDoctorContent').removeClass('invisibleObject');
						var target = $('.mainBlockDiv').attr('href');
						$('body').animate({scrollTop: $(target).offset().top}, 1000);
					});
					$('#findUserBut').click(function(){
						$.post('php/findUser.php', {card: $('#card').val()}, function(result){
							$('#findUserResult').html(result);
						});
					});
					$('body').on('click', '#addDoctorButton', function(){
						$.post('php/addDoctor.php', {card: $('#card').val(), rank: $('#rank').val(), rankNumber: $('#rankNumber').val()}, function(result){
							if(result == 'excellent')
								location.href=location.href;
							else
								$('#resultAddDoctor').html(result);
						});
					});
					$(function(){
						$('.krestikDelete').click(function(){
							$.post('php/deleteDoctor.php', {card: $(this).attr('card')}, function(result){
								if(result = 'excellent') location.href = location.href;
								else alert(result);
							});
						});
					});
				</script>
			<?php //-------------------------------
			}
			//-------------------------------------?>
			<div class="telephone">
				<table>
					<tr class="mediumTextWhite" bgcolor="#2C71C1">
						<td>Должность</td><td>ФИО</td><td colspan="2">Номер телефона</td>
					</tr>
					<?php 
						$result = $mysqli->query('SELECT Card, Rank FROM Doctors WHERE RankNumber = 1 OR RankNumber = 2');
						$colorTable = 0;
						while($arr = $result->fetch_assoc()){
							$res = $mysqli->query('SELECT Fam, Imya, Otch, Phone FROM Users WHERE Card = '.$arr['Card'])->fetch_assoc();
							echo '<tr bgcolor="'.($colorTable++ % 2 ? '#EEEBEB' : '#F5F5F5').'" class="mediumTextBlack"><td>'.$arr['Rank'].'</td><td>'.$res['Fam'].' '.$res['Imya'].' '.$res['Otch'].'</td><td>'.$res['Phone'].'</td>'.($adminOption ? '<td><img card="'.$arr['Card'].'" class="krestikDelete" src="/icons/krestik.svg"></td>' : '').'</tr>';
						}
						$mysqli->close();
					?>
				</table>
			</div>
		</div>

	</body>
</div>
	<!--        FOOTER          -->
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/templates/footer.php'); ?>
</div></html>