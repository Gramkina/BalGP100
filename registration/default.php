<div class="confrimEmail" style="background-color: #F2F2F2; width: 500px; margin: auto;" hidden>
	<center style="font-family: Roboto; font-weight: bold; font-size: 20px; color: #494949; margin-top: 10px">Подтверждение регистрации</center>
	<center><img src="/icons/iconEmail.svg" style="width: 120px; height: 80px; margin-top: 20px;"></center>
	<div class="confirmEmailText" style="font-family: Roboto; font-weight: bold; font-size: 14px; color: #494949; margin-top: 20px; padding-left: 20px; margin-bottom: 30px;"></div>
	<center style="font-family: Roboto; font-weight: bold; font-size: 17px; margin-bottom: 20px;"><a style="color: #2564AC;" href="index.php">Вернуться на главную</a></center>
</div>
		
<div class="contentRegistration">						
	<div class="headReg">
        <a style="margin-top:20px;" href="/"><img src="/icons/backArrow.svg"></a>
        <div style="margin: 25px 0 30px 0; padding-left: 200px;"><font class="FormRegistrationName">Форма регистрации</font></div>
    </div>	
	<font class="fontNameInputReg">Поля отмеченные звездочкой ( * ) обязательны для заполнения</font><br><br>
				
    <p style="margin: 10px 0 0 0;">
    <form id="registrationFormPHP" method="POST">
		<p style="margin: 10px 0 0 0;"><font class="fontNameInputReg">Элеткронная почта *</font>
		<div class="fullInputBlockReg">
			<div class="inputBlockReg">
				<div class="inputBlockRegistration">
					<div class="iconInputBlockReg">
						<img src="/icons/iconEmail.svg">
					</div>
					<input name="email" id="email" class="inputInputBlockReg" type="text" placeholder="Элеткронная почта">
				</div>
				<div class="help" data-title="На введенную вами электронную почту придет письмо с подтверждением регистрации. Используется для входа в аккаунт.">
					<img class="helpIcon" src="/icons/iconHelp.svg">
				</div>
			</div>
			<div class="blockErrorReg"></div>
		</div>
			
		<p style="margin: 10px 0 0 0;"><font class="fontNameInputReg">Пароль *</font>
		<div class="fullInputBlockReg">
			<div class="inputBlockReg">
				<div class="inputBlockRegistration">
					<div class="iconInputBlockReg">
						<img src="/icons/iconPassword.svg">
					</div>
					<input name="password" id="password" class="inputInputBlockReg" type="password" placeholder="Пароль">
				</div>
				<div class="help" data-title="Длина пароля должна быть от 6 до 30 символов. Пароль должен состоять из строчных или прописных букв латинского алфавита, а также из цифр от 0 до 9.">
					<img class="helpIcon" src="/icons/iconHelp.svg">
				</div>
			</div>
			<div class="blockErrorReg"></div>
		</div>
			
		<p style="margin: 10px 0 0 0;"><font class="fontNameInputReg">Пароль еще раз *</font>
		<div class="fullInputBlockReg">
			<div class="inputBlockReg">
				<div class="inputBlockRegistration">
					<div class="iconInputBlockReg">
						<img src="/icons/iconPassword.svg">
					</div>
					<input name="passwordE" id="passwordE" class="inputInputBlockReg" type="password" placeholder="Пароль">
				</div>
			</div>
			<div class="blockErrorReg"></div>
		</div>
			
		<p><hr style="width: 600px; height: 4px; border-radius: 10px; background-color:#2564AC;"></hr>
			
		<p style="margin: 10px 0 0 0;"><font class="fontNameInputReg">Фамилия *</font>
		<div class="fullInputBlockReg">
			<div class="inputBlockReg">
				<div class="inputBlockRegistration">
					<div class="iconInputBlockReg">
						<img src="/icons/Ф.svg">
					</div>
					<input name="fam" id="fam" class="inputInputBlockReg" type="text" placeholder="Фамилия">
				</div>
			</div>
			<div class="blockErrorReg"></div>
		</div>
			
		<p style="margin: 10px 0 0 0;"><font class="fontNameInputReg">Имя *</font>
		<div class="fullInputBlockReg">
			<div class="inputBlockReg">
				<div class="inputBlockRegistration">
					<div class="iconInputBlockReg">
						<img src="/icons/И.svg">
					</div>
					<input name="imya" id="im" class="inputInputBlockReg" type="text" placeholder="Имя">
				</div>
			</div>
			<div class="blockErrorReg"></div>
		</div>
				
		<p style="margin: 10px 0 0 0;"><font class="fontNameInputReg">Отчество</font>
		<div class="inputBlockReg">
			<div class="inputBlockRegistration">
				<div class="iconInputBlockReg">
					<img src="/icons/О.svg">
				</div>
				<input name="otch" id="otch" class="inputInputBlockReg" type="text" placeholder="Отчество">
			</div>
		</div>
			
		<p style="margin: 10px 0 0 0;"><font class="fontNameInputReg">Номер телефона *</font>
		<div class="fullInputBlockReg">
			<div class="inputBlockReg">
				<div class="inputBlockRegistration">
					<div class="iconInputBlockReg">
						<img src="/icons/iconNumber.svg">
					</div>
					<input name="phone" id="phone" class="inputInputBlockReg" type="text" placeholder="Номер телефона">
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
					<input name="birthday" id="birthday" class="inputInputBlockReg" type="date">
				</div>
			</div>
			<div class="blockErrorReg"></div>
        </div>

        <p style="margin: 10px 0 0 0;"><font class="fontNameInputReg">Пол *</font><br>
        <div class="fullInputBlockReg">
            <div class="inputBlockReg">
                <div class="inputBlockRegistration genderSelect">
                    <input type="radio" name="gender" id="Male" value="0" hidden><input type="radio" name="gender" id="Female" value="1" hidden>
                    <label for="Male" class="genderSelectLeft">Муж</label>
                    <label for="Female" class="genderSelectRight">Жен</label>
				</div>
			</div>
			<div class="blockErrorReg"></div>
        </div>
			
		<div class="errorCheckbox"></div>
		<input name="politik" id="politik" class="checkboxRegistration" type="checkbox"><font class="regPolitikFont"> Я согласен с </font><a target="_blank" href="/registration/Политика_безопасности.pdf"><font class="fontPolitikUrl">Политикой безопасности</font></a><br>
            
        <input id="regBut" class="registrationButton" type="button" value="Зарегистрироваться">	
	</form>
</div>