<head>
	<script src="/library/js/jquery.min.js"></script>
	<script src='/library/js/jquery.keyframes.min.js'></script>
	<link rel="stylesheet" type="text/css" href="/templates/css/header.css">
	<link rel="stylesheet" type="text/css" href="/css/fonts.css">
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php echo $_COOKIE['verSlab'] == 1 ? '<script src="https://lidrekon.ru/slep/js/uhpv-full.min.js"></script>' : ''; ?>
</head>
<div class="blockShadow" hidden></div>
<header>
	<div class="headerDesctop">
		<div class="headerVerhPolosa">
			<div>
				<div>Вызов врача на дом: +79046337244</div>
				<div>Справочная: +79046532554</div>
				<div>Неотложная помощь: 112 или 103</div>
				<img src="https://lidrekon.ru/images/special.png" style="width: 20px" onclick="verslab()">
			</div>
		</div>
		<div class="osnovaHeader">
			<div class="osnovaheaderContent">
				<div class="blockLogo">
					<a href="/"><img class="logo" src="/image/Logo.svg"></a>
				</div>
				<div class="pravOsnovaHeader">
					<div class="menuHeader">
						<a href="/" class="zaghref"><div class="elementMenuHeader mediumTextBlack">Главная</div></a>
						<div class="elementMenuHeader mediumTextBlack"><a href="/about" class="zaGhref">О поликлинике</a>
							<div class="headerMenuElement">
								<a href="/about/administration.php" class="zaghrefElement"><div>Администрация</div></a>
								<a href="/about/specialisten.php" class="zaghrefElement"><div>Специалисты</div></a>
								<a href="/about/raspisanie.php" class="zaghrefElement"><div>Расписание врачей</div></a>
								<a target="_blank" href="/registration/Политика_безопасности.pdf" class="zaghrefElement"><div>Политика безопасности</div></a>
							</div>
						</div>
						<div class="elementMenuHeader mediumTextBlack"><a href="/pacient" class="zaGhref">Пациентам</a>
							<div class="headerMenuElement">
								<a href="/pacient/news.php" class="zaghrefElement"><div>Новости</div></a>
								<a href="/pacient/zapis.php" class="zaghrefElement"><div>Запись на прием</div></a>
							</div>
						</div>
						<div class="elementMenuHeader mediumTextBlack"><a href="/contacts" class="zaGhref">Контакты</a>
							<div class="headerMenuElement">
								<a href="/contacts/comments.php" class="zaghrefElement"><div>Отзывы</div></a>
							</div>
						</div>
					</div>
					<div class="pravChastProfile">
						<label for="SignButtonOpen"><div class="headerButtonProfile largeTextBlue">Профиль</div></label>
					</div>
				</div>
			</div>
		</div>
		<input type="checkbox" id="SignButtonOpen" class="SignButton" hidden>
		<div class="Sign">
			<div class="SignContent">
			
			<?php if(!isset($_SESSION['user_card'])): ?>
				<div class="errorLogin"></div>
				<form method="POST" id="LogForm">
					<br>
					<font class="fontRegistrationBlock">Электронная почта</font><br>
					<div class="inputBlockSign">
						<div class="iconInputBlockSign">
							<img src="/icons/iconEmail.svg">
						</div>
						<input name="email" class="inputInputBlockSign" type="text" placeholder="Электронная почта">
					</div>
					<br>
					<font class="fontRegistrationBlock">Пароль</font><br>
					<div class="inputBlockSign">
						<div class="iconInputBlockSign">
							<img src="/icons/iconPassword.svg">
						</div>
					<input name="password" class="inputInputBlockSign" type="password" placeholder="Пароль">
					</div>
					<input name='remember' class="checkboxRegistrationSign" type="checkbox"><font class="fontRegistrationBlock"> запомнить</font>
					<br>
					<div class="signOsnovaBottom">
						<input id="LogBut" class="buttonSign" type="button" value="Войти">
						<div>
							<div class="smallfontRegistrationBlock"><a style="color:#F6F9F9" href="/registration.php">Регистрация</a></div>
							<div class="smallfontRegistrationBlock"><a style="color:#F6F9F9" href="/">Забыл пароль</a></div>
						</div>
					</div>
				</form>
				
				<?php else: ?>
				
				<div class="infoUser">
					<div class="fio">
						<div class="fioSign"><img src="/icons/ФSign.svg"><?php echo $array['Fam']; ?></div>
						<div class="fioSign"><img src="/icons/ИSign.svg"><?php echo $array['Imya']; ?></div>
						<div class="fioSign"><img src="/icons/ОSign.svg"><?php echo $array['Otch']; ?></div>
					</div>
					<img class="avatarSign" src="<?php echo $array['Avatar'] == null ? '/avatarUsers/noAvatar.svg' : '/avatarUsers/'.$array['Avatar']; ?>">
				</div>
				<div class="polosaSign"></div>
				<a href="/profile"><div class="punktSign"><div></div>Личный кабинет</div></a>
				<a href="/profile/zapisi.php"><div class="punktSign"><div></div>Записи на прием</div></a>
		
				<div class="DisLogBut"><input id="DisLogBut" class="buttonSign" type="button" value="Выйти"></div>
					
				<?php endif ?>
				
			</div>
		</div>
	</div>
	<div class="headerPhone">
		<input id="openMenuPhone" type="checkbox">
		<div class="headerPhoneDivTop"><label class="buttonMenuOpen" for="openMenuPhone"><img src="/icons/menuIconPhone.svg"></label><img class="phoneLogoHeader" src="/image/Logo.svg"></div>
		<div class="leftMenuDiv">
			<div class="leftMenuPhoto">
				<?php 
				if(!isset($_SESSION['user_card'])){ ?>
					<label for="profileCheckbox"><img src="/avatarUsers/noAvatar.svg"></label>
					<input type="checkbox" id="profileCheckbox" hidden>
					<div class="logDivPhone">
						<form id="logFormPhone">
							<div class="largeTextBlack">Почта</div>
							<input name="email" type="text" class="largeTextBlack">
							<div class="largeTextBlack">Пароль</div>
							<input name="password" type="password" class="largeTextBlack">
							<input type="button" id="logbuttonPhone" class="largeTextBlack" value="Войти">
						</form>
					</div>
				<?php
				} else{ ?>
					<label for="profileCheckbox"><img src="<?php echo $array['Avatar'] ? '/avatarUsers//'.$array['Avatar'] : '/avatarUsers/noAvatar.svg'; ?>"></label>
					<input type="checkbox" id="profileCheckbox" hidden>
					<div class="logDivPhone">
						<div class="largeTextBlack"><?php echo $array['Fam'].' '.$array['Imya'].' '.$array['Otch']; ?></div>
						<div class="phoneLK">
							<ul>
								<li>Личный кабинет</li>
								<li>Записи на прием</li>
							</ul>
						</div>
						<input type="button" value="Выйти">
					</div>
				<?php
				}?>
			</div>
			<div class="elementLeftMenu">Главная</div>
			<div>
				<label for="aboutCheckbox"><div class="elementLeftMenu">О поликлинике</div></label>
				<input type="checkbox" id="aboutCheckbox" hidden>
				<div>
					<a href="/about"><div class="elementLeftMenu"><li>О поликлинике</li></div></a>
					<a href="/about/administration.php"><div class="elementLeftMenu"><li>Администрация</li></div></a>
					<a href="/about/specialisten.php"><div class="elementLeftMenu"><li>Специалисты</li></div></a>
					<a href="/about/raspisanie.php"><div class="elementLeftMenu"><li>Расписание</li></div></a>
					<a href="/registration/Политика_безопасности.pdf"><div class="elementLeftMenu"><li>Пол. безопасности</li></div></a>
				</div>
			</div>
			<div>
				<label for="pacientCheckbox"><div class="elementLeftMenu">Пациентам</div></label>
				<input type="checkbox" id="pacientCheckbox" hidden>
				<div>
					<a href="/pacient"><div class="elementLeftMenu"><li>Пациентам</li></div></a>
					<a href="/pacient/news.php"><div class="elementLeftMenu"><li>Новости</li></div></a>
					<a href="/pacient/zapis.php"><div class="elementLeftMenu"><li>Записаться на прием</li></div></a>
				</div>
			</div>
			<div class="elementLeftMenu">Контакты</div>
		</div>
	</div>
</header>

<script>
	$("#LogBut").click(function(e){
		$.ajax({
			url: "/templates/php/sign.php",
			data: $("#LogForm").serialize(),
			type: 'POST',
			success:function(result){
				switch(result){
					case "0":{
						$(".errorLogin").html("Неправильная почта или пароль");
						break;
					}
					case "1":{
						location.href = window.location.href;
						break;
					}
				}
			}
		})
	});
	$("#DisLogBut").click(function(e){
		$.ajax({
			url: "/templates/php/logout.php",
			type: "POST",
			success:function(result){
				location.href = window.location.href;
			}
		});
	});
	$('#openMenuPhone').click(function(){
		if($(this).is(":checked")) $('.blockShadow').show();
		else $('.blockShadow').hide();
	});
	$('#logbuttonPhone').click(function(){
		$.ajax({
			url: "/templates/php/sign.php",
			data: $("#logFormPhone").serialize(),
			type: 'POST',
			success:function(result){
				switch(result){
					case "0":{
						$(".errorLogin").html("Неправильная почта или пароль");
						break;
					}
					case "1":{
						location.href = window.location.href;
						break;
					}
				}
			}
		})
	});
	function verslab(){
		ar = document.cookie.split(';');
		for(i = 0; i<ar.length; i++){
			if(ar[i] == "verSlab=1" || ar[i] == " verSlab=1" ){
				document.cookie = "verSlab=0";
				location.href = location.href;
				break;
			}
			else if(ar[i] == "verSlab=0" || ar[i] == " verSlab=0"){
				document.cookie = "verSlab=1";
				location.href = location.href;
				break;
			}
			if(i == ar.length-1){
				document.cookie = "verSlab=1";
				location.href = location.href;
				break;
			}
		}
	}
</script>