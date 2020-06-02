<div class="step">
	<div class="stepZapisDiv1">
		<div class="disabledStepZapisDiv largeTextWhite">1</div><div class="largeTextBlack stepName">Выберите врача</div><img src="/icons/galochka.svg">
	</div>
	<div class="contentStep">
		<div class="step1input1"><div class="mediumTextBlack">Выберите специальность</div><img src="/icons/galochka.svg"></div>
		<select class="selectSpec mediumTextBlack" disabled>
			<option selected><?php echo $doctors['Rank']; ?></option>
		</select>
		<div id="resultSpec"><div class="step1input2"><div class="mediumTextBlack">Выберите врача</div><img src="/icons/galochka.svg"></div>
			<select class="selectSpec mediumTextBlack" id="selectDoctor" disabled>
				<option selected card="<?php echo $_GET['Doctor']; ?>"><?php echo $users['Fam'].' '.$users['Imya'].' '.$users['Otch']; ?></option>
			</select>
		</div>
		<div class="divNextStep"><input href="#contentStep2" type="button" class="nextStepButton mediumTextBlack" value="Далее" disabled></div>
	</div>
</div>
<div class="step">
	<div class="stepZapisDiv2">
		<div class="selectStepZapisDiv largeTextWhite">2</div><div class="largeTextBlack stepName">Выберите дату приема</div>
	</div>
	<div id="contentStep2" class="contentStep visibileObject">
		<div class="step2input1"></div>
		<div id="resultRaspisanie" class="resultRaspisanieGif"><img src="/gif/loading.gif"></div>
		<div class="divNextStep"><input id="step2NextButton" type="button" class="nextStepButton mediumTextBlack" value="Далее" hidden></div>
	</div>
</div>
<div class="step">
	<div class="stepZapisDiv3">
		<div class="selectStepZapisDiv largeTextWhite">3</div><div class="largeTextBlack stepName">Подтверждение</div>
	</div>
	<div id="contentStep3" class="contentStep visibileObject">
		<div class="mediumTextBlack">На почту <?php echo $stmt = $mysqli->query('SELECT Email FROM Users WHERE Card = '.$_SESSION['user_card'])->fetch_assoc()['Email']; ?> было отправлено письмо с кодом. Для продолжения необходимо ввести его в поле.</div>
		<div class="input1step3"><input class="codeInput" type="text" id="codeVer" placeholder="Код"><div class="resultCode mediumTextRed"></div></div>
		<div class="divNextStep"><input id="step3NextButton" type="button" class="nextStepButton mediumTextBlack" value="Продолжить"></div>
	</div>
</div>
<script src="js/GETZapisi.js"></script>