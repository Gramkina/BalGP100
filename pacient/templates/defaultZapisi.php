<div class="step">
	<div class="stepZapisDiv1">
    	<div class="selectStepZapisDiv largeTextWhite">1</div><div class="largeTextBlack stepName">Выберите врача</div>
	</div>
	<div class="contentStep">
		<div class="step1input1"><div class="mediumTextBlack">Выберите специальность</div></div>
		<select class="selectSpec mediumTextBlack" id="selectSpecial">
			<option hidden disabled selected></option>
			<?php 
				require_once($_SERVER['DOCUMENT_ROOT'].'/php/db/db.php');
				$mysqli = new mysqli($hostDB, $userDB, $passwordDB, $database);
				$result = $mysqli->query('SELECT DISTINCT Rank FROM Doctors WHERE RankNumber = 1 OR RankNumber = 3');
				while($doctors = $result->fetch_assoc()){ ?>
					<option><?php echo $doctors['Rank']; ?></option>
			<?php } ?>
		</select>
		<div id="resultSpec"></div>
		<div class="divNextStep"><input href="#contentStep2" id="step1NextButton" type="button" class="nextStepButton mediumTextBlack" value="Далее" hidden></div>
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
<script src="js/zapisi.js"></script>