<?php include($_SERVER['DOCUMENT_ROOT'].'/php/loginPage.php');?>
<div class="newContent">
	<form id="cProf">
		<font class="fontNameInputReg">Фамилия</font>
		<div class="fullInputBlockReg">
			<div class="inputBlockReg">
				<div class="inputBlockRegistration">
					<div class="iconInputBlockReg">
						<img src="/icons/Ф.svg">
					</div>
					<input name="fam" id="fam" class="inputInputBlockReg" type="text" placeholder="Фамилия" value="<?php echo $array['Fam']; ?>">
				</div>
			</div>
			<div class="blockErrorReg"></div>
		</div>

		<p style="margin: 10px 0 0 0;"><font class="fontNameInputReg">Имя</font>
		<div class="fullInputBlockReg">
			<div class="inputBlockReg">
				<div class="inputBlockRegistration">
					<div class="iconInputBlockReg">
						<img src="/icons/И.svg">
					</div>
					<input name="imya" id="im" class="inputInputBlockReg" type="text" placeholder="Имя" value="<?php echo $array['Imya']; ?>">
				</div>
			</div>
			<div class="blockErrorReg"></div>
		</div>

		<p style="margin: 10px 0 0 0;"><font class="fontNameInputReg">Отчество</font>
		<div class="fullInputBlockReg">
			<div class="inputBlockReg">
				<div class="inputBlockRegistration">
					<div class="iconInputBlockReg">
						<img src="/icons/О.svg">
					</div>
					<input name="otch" id="otch" class="inputInputBlockReg" type="text" placeholder="Отчество" value="<?php echo $array['Otch']; ?>">
				</div>
			</div>
			<div class="blockErrorReg"></div>
		</div>

		<p style="margin: 10px 0 0 0;"><font class="fontNameInputReg">Номер телефона</font>
		<div class="fullInputBlockReg">
			<div class="inputBlockReg">
				<div class="inputBlockRegistration">
					<div class="iconInputBlockReg">
						<img src="/icons/iconNumber.svg">
					</div>
					<input name="phone" id="phone" class="inputInputBlockReg" type="text" placeholder="Номер телефона" value="<?php echo $array['Phone']; ?>">
				</div>
				<div class="help" data-title="Номер вашего мобильного телефона. Поле должно быть указано в формате +7xxxxxxxxxx или 8xxxxxxxxxx">
					<img class="helpIcon" src="/icons/iconHelp.svg">
				</div>
			</div>
			<div class="blockErrorReg"></div>
		</div>
		
		<p style="margin: 10px 0 0 0;"><font class="fontNameInputReg">Дата рождения *</font>
		<div class="fullInputBlockReg">
			<div class="inputBlockReg">
				<div class="inputBlockRegistration">
					<div class="iconInputBlockReg">
						<img style="width: 17px;" src="/icons/birthday.svg">
					</div>
					<input name="birthday" id="birthday" class="inputInputBlockReg" value="<?php echo $array['Date']; ?>" type="date">
				</div>
			</div>
			<div class="blockErrorReg"></div>
		</div>
		
		<p style="margin: 10px 0 0 0;"><font class="fontNameInputReg">Пол *</font><br>
		<div class="fullInputBlockReg">
			<div class="inputBlockReg">
				<div class="inputBlockRegistration genderSelect">
					<input type="radio" name="gender" id="Male" value="0" hidden <?php echo $array['Gender'] == 0 ? 'checked' : ''; ?>><input type="radio" name="gender" id="Female" value="1" hidden <?php echo $array['Gender'] == 1 ? 'checked' : ''; ?>>
					<label for="Male" class="genderSelectLeft">Муж</label>
					<label for="Female" class="genderSelectRight">Жен</label>
				</div>
			</div>
			<div class="blockErrorReg"></div>
		</div>
	</form>

	<p style="margin: 20px 0 0 0;">
	<div class="disFlex">
		<div class="photoUpdateText">
			<div class="smallTextBlack">Вы можете загрузить изображение в формате JPG или PNG. Размер загружаемого изображения не должен превышать 512кБ.</div>
			<input id="inputFileAvatar" type="file" class="hiddenClass" accept="image/jpeg, image/png">
			<label class="buttonSaveProfileAvatar mediumTextBlack" for="inputFileAvatar">Загрузить фото</label>
		</div>
		<div class="avatarImg">
			<img id="imgAvatar" src="<?php echo $array['Avatar'] == null ? '/avatarUsers/noAvatar.svg' : '/avatarUsers/'.$array['Avatar']; ?>">
		</div>
	</div>
	<p style="margin: 5px 0 0 0;">
	<div id="resultAvatar" class="mediumTextBlack hiddenClass disFlex">Пожалуйста подождите...<img src="/gif/loading.gif" style="width:30px;"></div>

	<div style="margin: 40px 0 0 0;">
		<div id="resultChangeProfile" class="mediumTextGreen hiddenClass disFlex"></div>
		<input id="changeProfileButton" type="button" class="buttonSaveProfileChange mediumTextBlack" value="Сохранить изменения">
	</div>
</div>

<script src='js/changeProfile.js'></script>