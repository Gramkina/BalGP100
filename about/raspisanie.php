<?php 
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/loginPage.php');
	require_once($_SERVER['DOCUMENT_ROOT'].'/php/adminLogin.php');
?>

<html><div class="wrapper">
	<head>
		<title>О поликлинике - Расписание врачей</title>
		<link rel="stylesheet" type="text/css" href="css/about.css">
		<meta charset="utf-8">
	</head>

<div>	
	<!--        HEADER          -->
	<?php include($_SERVER['DOCUMENT_ROOT'].'/templates/header.php'); ?>

	<body>
		<div class="path mediumTextBlue"><span><a href="/">Главная</a> • <a href="/about">О поликлинике</a> • <a href="/about/raspisanie.php">Расписание врачей</a></span></div>
		<div class='content'>
			<div class="veryLargeTextBlack">Расписание врачей</div>
			<div class="polosaGray"><div></div></div>
			<div class="findRaspisanieDiv">
				<div class="mediumTextBlack">Поиск</div><input type="text" id="textFind" class="findRaspisanieText mediumTextBlack"><input type="button" class="mediumTextBlack" id="buttonFind" value="Найти">
			</div>
			<div id="resultFind">
			<?php
				require_once($_SERVER['DOCUMENT_ROOT'].'/php/db/db.php');
				$mysqli = new mysqli($hostDB, $userDB, $passwordDB, $database);
				$result = $mysqli->query('SELECT * FROM Raspisanie');
				while($raspisanie = $result->fetch_assoc()){
					$users = $mysqli->query('SELECT Fam, Imya, Otch FROM Users WHERE Card = '.$raspisanie['Card'])->fetch_assoc();
					$doctors = $mysqli->query('SELECT Rank FROM Doctors WHERE Card = '.$raspisanie['Card'])->fetch_assoc();
					?>
					<div class="raspisanieDiv">
						<div class="raspisanieInfoDoctor">
							<div class="mediumTextBlack rankDoctor" rank="<?php echo mb_strtolower($doctors['Rank']); ?>"><?php echo $doctors['Rank'].' - '; ?><div <?php echo $adminOption ? 'cabinet="'.$raspisanie['Cabinet'].'"' : ''; ?> <?php echo $adminOption ? 'changeNumberOpen="false"' : ''; ?> class="cabinet">кабинет <?php echo $raspisanie['Cabinet'] != null ? $raspisanie['Cabinet'] : '?'; ?></div></div>
							<div class="mediumTextBlue"><?php echo $users['Fam'].' '.$users['Imya'].' '.$users['Otch']; ?></div>
							<div class="mediumTextBlack">Сегодня:<?php echo $raspisanie[date('l')] == null ? '<font class="mediumTextRed"> нет приема</font>' : '<font class="mediumTextGreen"> '.$raspisanie[date('l')].'</font>'; ?></div>
						</div>
						<div class="raspisanieInfoRaspisanie" card="<?php echo $adminOption ? $raspisanie['Card'] : ''; ?>">
							<div class="raspisanieDayNed" <?php echo $adminOption ? 'changeOpen="false"' : ''; ?>>
								<div class="largeTextBlack raspisanieDay" <?php echo $adminOption ? 'day="Monday"' : ''; ?>>Понедельник</div>
								<div class="mediumTextBlack raspisanieTime"><?php echo $raspisanie['Monday'] != null ? $raspisanie['Monday'] : '-'; ?></div>
							</div>
							<div class="raspisanieDayNed" <?php echo $adminOption ? 'changeOpen="false"' : ''; ?>>
								<div class="largeTextBlack raspisanieDay" <?php echo $adminOption ? 'day="Tuesday"' : ''; ?>>Вторник</div>
								<div class="mediumTextBlack raspisanieTime"><?php echo $raspisanie['Tuesday'] != null ? $raspisanie['Tuesday'] : '-'; ?></div>
							</div>
							<div class="raspisanieDayNed" <?php echo $adminOption ? 'changeOpen="false"' : ''; ?>>
								<div class="largeTextBlack raspisanieDay" <?php echo $adminOption ? 'day="Wednesday"' : ''; ?>>Среда</div>
								<div class="mediumTextBlack raspisanieTime" ><?php echo $raspisanie['Wednesday'] != null ? $raspisanie['Wednesday'] : '-'; ?></div>
							</div>
							<div class="raspisanieDayNed" <?php echo $adminOption ? 'changeOpen="false"' : ''; ?>>
								<div class="largeTextBlack raspisanieDay" <?php echo $adminOption ? 'day="Thursday"' : ''; ?>>Четверг</div>
								<div class="mediumTextBlack raspisanieTime"><?php echo $raspisanie['Thursday'] != null ? $raspisanie['Thursday'] : '-'; ?></div>
							</div>
							<div class="raspisanieDayNed" <?php echo $adminOption ? 'changeOpen="false"' : ''; ?>>
								<div class="largeTextBlack raspisanieDay" <?php echo $adminOption ? 'day="Friday"' : ''; ?>>Пятница</div>
								<div class="mediumTextBlack raspisanieTime"><?php echo $raspisanie['Friday'] != null ? $raspisanie['Friday'] : '-'; ?></div>
							</div>
						</div>
					</div>
			<?php }
			?>
			</div>
		</div>

	</body>
</div>
	<!--        FOOTER          -->
	<?php require_once($_SERVER['DOCUMENT_ROOT'].'/templates/footer.php'); ?>
</div></html>

<script>
	$('#buttonFind').click(function(){
		text = $('#textFind').val().toLowerCase();
		if(text == '')
			$('.rankDoctor').parent().parent().show();
		else{
			$('.rankDoctor').parent().parent().hide();
			$('.rankDoctor').each(function(){
				if($(this).attr('rank').indexOf(text) != -1)
					$(this).parent().parent().show();
			});
		}
	});
	<?php 
		if($adminOption){ ?>
	timeVR = 0;
	$('.raspisanieDayNed').dblclick(function(){
		if($(this).attr('changeOpen') == 'false'){
			$('.raspisanieDayNed[changeOpen=true]').children().remove('.raspisanieTimeChange').parent().append('<div class="mediumTextBlack raspisanieTime">'+timeVR+'</div>')
			$('.raspisanieDayNed[changeOpen=true]').attr('changeOpen', 'false');
			$(this).attr('changeOpen', 'true');
			timeVR = $(this).children(".raspisanieTime").text();
			time = timeVR.split('-');
			$(this).children().remove('.raspisanieTime');
			$(this).append('<div class="raspisanieTimeChange"><div class="inputs"><input type="time" class="smallTextBlack time0" value='+time[0]+'>-<input class="smallTextBlack time1" type="time" value='+time[1]+'></div><div class="saveChangeTime"><img class="closeChangeTime" src="/icons/krestik.svg"><img class="saveChange" src="/icons/galochka.svg"></div></div>');
		}
	});
	$('body').on('click', '.closeChangeTime', function(){
		$('.raspisanieDayNed[changeOpen=true]').children().remove('.raspisanieTimeChange').parent().append('<div class="mediumTextBlack raspisanieTime">'+timeVR+'</div>')
		$('.raspisanieDayNed[changeOpen=true]').attr('changeOpen', 'false');
	});
	$('body').on('click', '.saveChange', function(e){
		card = $(e.target).parent().parent().parent().parent().attr('card');
		day = $(e.target).parent().parent().parent().children("div.largeTextBlack.raspisanieDay").attr('day');
		time0 = $(e.target).parent().parent().children().children("input.smallTextBlack.time0").val();
		time1 = $(e.target).parent().parent().children().children("input.smallTextBlack.time1").val();
		$.post('php/changeTime.php', {card: card, day: day, time0: time0, time1: time1}, function(result){
			alert(result);
			location.href = location.href;
		})
	});
	cabinetVR = 0;
	$('body').on('click', '.closeCabinet', function(){
		$('.cabinet[changeNumberOpen=true]').attr('changeNumberOpen', 'false').children().remove('.cabinetNumber').append(cabinetVR);
	});
	$('body').on('click', '.saveCabinet', function(e){
		card = $(e.target).parent().parent().parent().parent().parent().children('div.raspisanieInfoRaspisanie').attr('card');
		cabinet = $(e.target).parent().children('input').val();
		$.post('php/changeCabinet.php', {card: card, cabinet: cabinet}, function(result){
			alert(result);
			location.href = location.href;
		})
	});
	$('.cabinet').dblclick(function(){
		if($(this).attr('changeNumberOpen') == 'false'){
			$('.cabinet[changeNumberOpen=true]').attr('changeNumberOpen', 'false').children().remove('.cabinetNumber').append(cabinetVR);
			cabinetVR = $(this).attr('cabinet');
			$(this).attr('changeNumberOpen', 'true');
			$(this).append('<div class="cabinetNumber"><input type=text value='+cabinetVR+'><img class="closeCabinet" src="/icons/krestik.svg"><img class="saveCabinet" src="/icons/galochka.svg"></div>');
		}
	});
	<?php } ?>
</script>