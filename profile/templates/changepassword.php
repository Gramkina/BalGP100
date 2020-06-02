<?php include($_SERVER['DOCUMENT_ROOT'].'/php/loginPage.php');?>
<div class="newContent">
    <form id="formChangePassword">

		<div class="mediumTextBlack" style="border: 1px solid #2C71C1; padding: 5px;">Для того, чтобы изменить пароль к вашему аккаунуту, необходимо указать старый пароль, а затем новый. Для того, чтобы новый пароль вступил в силу, необходимо подтверждение по почте.</div><br>

        <font class="fontNameInputReg">Старый пароль</font>
		<div class="fullInputBlockReg">
			<div class="inputBlockReg">
				<div class="inputBlockRegistration">
					<div class="iconInputBlockReg">
						<img src="/icons/iconPassword.svg">
					</div>
					<input name="oldPassword" id="oldPassword" class="inputInputBlockReg" type="password">
				</div>
			</div>
			<div class="blockErrorReg"></div>
        </div>
        
        <p style="margin: 10px 0 0 0">
        <font class="fontNameInputReg">Новый пароль</font>
		<div class="fullInputBlockReg">
			<div class="inputBlockReg">
				<div class="inputBlockRegistration">
					<div class="iconInputBlockReg">
						<img src="/icons/iconPassword.svg">
					</div>
					<input name="newPassword" id="newPassword" class="inputInputBlockReg" type="password">
				</div>
				<div class="help" data-title="Длина пароля должна быть от 6 до 30 символов. Пароль должен состоять из строчных или прописных букв латинского алфавита, а также из цифр от 0 до 9.">
					<img class="helpIcon" src="/icons/iconHelp.svg">
				</div>
			</div>
			<div class="blockErrorReg"></div>
        </div>
        
        <p style="margin: 10px 0 0 0">
        <font class="fontNameInputReg">Новый пароль еще раз</font>
		<div class="fullInputBlockReg">
			<div class="inputBlockReg">
				<div class="inputBlockRegistration">
					<div class="iconInputBlockReg">
						<img src="/icons/iconPassword.svg">
					</div>
					<input name="newPasswordE" id="newPasswordE" class="inputInputBlockReg" type="password">
				</div>
			</div>
			<div class="blockErrorReg"></div>
        </div>
        
        <div style="margin: 40px 0 0 0;">
		    <div id="resultChangePassword">
				<?php if($_GET['code'] != null){
					$error = '<div class="mediumTextRed disFlex">Ошибка<img src="/icons/krestik.svg" width=20px></div>';
					include($_SERVER['DOCUMENT_ROOT'].'/php/db/db.php');
					$mysql = new mysqli($hostDB, $userDB, $passwordDB, $database) or die($error);
					$stmt = $mysql->prepare('SELECT * FROM Change_Password WHERE Code = ?') or die($error);
					$stmt->bind_param("s", $_GET['code']) or die($error);
					$stmt->execute() or die($error);
					$result = $stmt->get_result()->fetch_assoc();
					if($result != null){
						$mysql->query('DELETE FROM Change_Password WHERE Card = '.$result['Card']) or die($error);
						$mysql->query('UPDATE Users SET Password = "'.$result['NewPassword'].'" WHERE Card = '.$result['Card']) or die($error);
						echo '<div class="mediumTextGreen disFlex">Пароль успешно изменен<img src="/icons/galochka.svg" style="width:20px; margin-left: 5px;"></div>';
					}
					else echo $error;
				} ?>
			</div>
		    <input id="changePasswordButton" type="button" class="buttonChangePassword mediumTextBlack" value="Изменить пароль">
	    </div>
    </form>
</div>

<script>
	krestik = "<img src='/icons/krestik.svg' width=20px>"
	$("input").focusout(function(e){
		inputD = $("#" + e.target.id);
		switch(e.target.id){
			case "newPassword":{
				inputD.parent().parent().parent().find(".blockErrorReg").html( 
					(inputD.val().length < 6 || inputD.val().length > 30) ? "Пароль должно иметь длину от 6 до 30 символов" :
					(!inputD.val().match(/^[a-zA-Z\d]{6,30}$/)) ? "Пароль может содержать только заглавные и строчные буквы латинского алфавита, а также цифры от 0 до 9" : "");
				inputD.css('outline', (inputD.val().length < 6 || inputD.val().length > 30 || !inputD.val().match(/^[a-zA-Z\d]{6,30}$/)) ? "1px solid #A80000" : "none");
				$("#newPasswordE").parent().parent().parent().find(".blockErrorReg").html((inputD.val() != $("#newPasswordE").val()) ? "Пароли не совпадают" : "");
				$("#newPasswordE").css("outline", (inputD.val() != $("#newPasswordE").val()) ? "1px solid #A80000" : "none");
				break;
			}
			case "newPasswordE":{
				inputD.parent().parent().parent().find(".blockErrorReg").html((inputD.val() != $("#newPasswordE").val()) ? "Пароли не совпадают" : "");
				inputD.css("outline", (inputD.val() != $("#newPasswordE").val()) ? "1px solid #A80000" : "none");
				break;
			}
			case "oldPassword":{
				inputD.parent().parent().parent().find(".blockErrorReg").html((inputD.val() == '') ? "Поле должно быть заполнено" : "");
				inputD.css("outline", ((inputD.val() == '')) ? "1px solid #A80000" : "none");
				break;
			}
		}
	});
	$("#changePasswordButton").click(function(e){
		if(!$("#newPassword").val().match(/^[a-zA-Z\d]{6,30}$/) || $("#newPassword").val() != $("#newPasswordE").val() || $("#oldPassword").val() == ''){
			$("#newPasswordE").parent().parent().parent().find(".blockErrorReg").html(($("#newPasswordE").val() != $("#newPassword").val()) ? "Пароли не совпадают" : "");
			$("#newPasswordE").css("outline", ($("#newPassword").val() != $("#newPasswordE").val()) ? "1px solid #A80000" : "none");
			$("#oldPassword").parent().parent().parent().find(".blockErrorReg").html(($("#oldPassword").val() == '') ? "Поле должно быть заполнено" : "");
			$("#oldPassword").css("outline", (($("oldPassword").val() == '')) ? "1px solid #A80000" : "none");
			$("#newPassword").parent().parent().parent().find(".blockErrorReg").html( 
			($("#newPassword").val().length < 6 || $("#newPassword").val().length > 30) ? "Пароль должно иметь длину от 6 до 30 символов" :
			(!$("#newPassword").val().match(/^[a-zA-Z\d]{6,30}$/)) ? "Пароль может содержать только заглавные и строчные буквы латинского алфавита, а также цифры от 0 до 9" : "");
			inputD.css('outline', ($("#newPassword").val().length < 6 || $("#newPassword").val().length > 30 || !$("#newPassword").val().match(/^[a-zA-Z\d]{6,30}$/)) ? "1px solid #A80000" : "none");
		} else{
			rAva = $("#resultChangePassword");
			rAva.html('<div class="mediumTextBlack disFlex">Пожалуйста подождите...<img src="/gif/loading.gif" style="width:30px;"></div>');
			$.ajax({
				url: "php/changePassword.php",
				data: $("#formChangePassword").serialize(),
				type: 'POST',
				success:function(result){
					rAva.html(result);
				}
			});
		}
	});
</script>