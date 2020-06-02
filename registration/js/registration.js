	$("input").focusout(function(e){
		inputD = $("#" + e.target.id);
		switch(e.target.id){
			case "password":{
				inputD.parent().parent().parent().find(".blockErrorReg").html( 
					(inputD.val().length < 6 || inputD.val().length > 30) ? "Пароль должно иметь длину от 6 до 30 символов" :
					(!inputD.val().match(/^[a-zA-Z\d]{6,30}$/)) ? "Пароль может содержать только заглавные и строчные буквы латинского алфавита, а также цифры от 0 до 9" : "");
				inputD.css('outline', (inputD.val().length < 6 || inputD.val().length > 30 || !inputD.val().match(/^[a-zA-Z\d]{6,30}$/)) ? "1px solid #A80000" : "none");
				$("#passwordE").parent().parent().parent().find(".blockErrorReg").html((inputD.val() != $("#passwordE").val()) ? "Пароли не совпадают" : "");
				$("#passwordE").css("outline", (inputD.val() != $("#passwordE").val()) ? "1px solid #A80000" : "none");
				break;
			}
			case "passwordE":{
				inputD.parent().parent().parent().find(".blockErrorReg").html((inputD.val() != $("#password").val()) ? "Пароли не совпадают" : "");
				inputD.css("outline", (inputD.val() != $("#password").val()) ? "1px solid #A80000" : "none");
				break;
			}
			case "email":{
				inputD.parent().parent().parent().find(".blockErrorReg").html((inputD.val().length == null || (inputD.val().match(/.+?\@.+/g) || []).length !== 1) ? "Неверно указан адрес электронной почты" : "");
				inputD.css("outline", (inputD.val().length == null || (inputD.val().match(/.+?\@.+/g) || []).length !== 1) ? "1px solid #A80000" : "none");
				break;
			}
			case "fam":{
				inputD.parent().parent().parent().find(".blockErrorReg").html((inputD.val() == null || inputD.val().length < 3) ? "Неверно указана фамилия" : "");
				inputD.css("outline", (inputD.val() == null || inputD.val().length < 3) ? "1px solid #A80000" : "none");
				break;
			}
			case "im":{
				inputD.parent().parent().parent().find(".blockErrorReg").html((inputD.val() == null || inputD.val().length < 3) ? "Неверно указано имя" : "");
				inputD.css("outline", (inputD.val() == null || inputD.val().length < 3) ? "1px solid #A80000" : "none");
				break;
			}
			case "phone":{
				inputD.parent().parent().parent().find(".blockErrorReg").html((!inputD.val().match(/^[\+*7]{2}\d{10}$|^[8]\d{10}$/)) ? "Неверно указан номер телефона" : "");
				inputD.css("outline", (!inputD.val().match(/(\+7|8)\d{10}$/)) ? "1px solid #A80000" : "none");
				break;
			}
			case "birthday":{
				inputD.parent().parent().parent().find(".blockErrorReg").html((inputD.val() == '' || new Date() - new Date(inputD.val()) < 0) ? "Неверно указана дата рождения" : "");
				inputD.css("outline", (inputD.val() == '' || new Date() - new Date(inputD.val()) < 0) ? "1px solid #A80000" : "none");
			}
		}
	});
	
	$('#politik').change(function() {
		$(".errorCheckbox").html((!$("#politik").prop('checked')) ? "Для продолжения регистрации необходимо ознакомиться с политикой безопасности" : "");
	});

	$("#regBut").click(function(e){
		if($("#password").val().length > 30 || $("#password").val().length < 6 || !$("#password").val().match(/^[a-zA-Z\d]{6,30}$/) ||
		   $("#password").val() != $("#passwordE").val() || $("#email").val() == null || ($("#email").val().match(/.+?\@.+/g) || []).length !== 1 ||
		   $("#fam").val().length < 3 || $("#im").val().length < 3 || !$("#phone").val().match(/^[\+*7]{2}\d{10}$|^[8]\d{10}$/) || !$("#politik").prop('checked') ||
		   $("input:radio:hidden:checked[name=gender]").val() == null || $("#birthday").val() == '' || new Date() - new Date($("#birthday").val()) < 0
		){
			$("#password").parent().parent().parent().find(".blockErrorReg").html( 
			($("#password").val().length < 6 || $("#password").val().length > 30) ? "Пароль должно иметь длину от 6 до 30 символов" :
			(!$("#password").val().match(/^[a-zA-Z\d]{6,30}$/)) ? "Пароль может содержать только заглавные и строчные буквы латинского алфавита, а также цифры от 0 до 9" : "");
			$("#password").css('outline', ($("#password").val().length < 6 || $("#password").val().length > 30 || !$("#password").val().match(/^[a-zA-Z\d]{6,30}$/)) ? "1px solid #A80000" : "none");
			$("#passwordE").parent().parent().parent().find(".blockErrorReg").html(($("#password").val() != $("#passwordE").val()) ? "Пароли не совпадают" : "");
			$("#passwordE").css("outline", ($("#password").val() != $("#passwordE").val()) ? "1px solid #A80000" : "none");
			$("#passwordE").parent().parent().parent().find(".blockErrorReg").html(($("#passwordE").val() != $("#password").val()) ? "Пароли не совпадают" : "");
			$("#passwordE").css("outline", ($("#passwordE").val() != $("#password").val()) ? "1px solid #A80000" : "none");
			$("#email").parent().parent().parent().find(".blockErrorReg").html(($("#email").val().length == null || ($("#email").val().match(/.+?\@.+/g) || []).length !== 1) ? "Неверно указан адрес электронной почты" : "");
			$("#email").css("outline", ($("#email").val().length == null || ($("#email").val().match(/.+?\@.+/g) || []).length !== 1) ? "1px solid #A80000" : "none");
			$("#fam").parent().parent().parent().find(".blockErrorReg").html(($("#fam").val() == null || $("#fam").val().length < 3) ? "Неверно указана фамилия" : "");
			$("#fam").css("outline", ($("#fam").val() == null || $("#fam").val().length < 3) ? "1px solid #A80000" : "none");
			$("#im").parent().parent().parent().find(".blockErrorReg").html(($("#im").val() == null || $("#im").val().length < 3) ? "Неверно указано имя" : "");
			$("#im").css("outline", ($("#im").val() == null || $("#im").val().length < 3) ? "1px solid #A80000" : "none");
			$("#phone").parent().parent().parent().find(".blockErrorReg").html((!$("#phone").val().match(/^[\+*7]{2}\d{10}$|^[8]\d{10}$/)) ? "Неверно указан номер телефона" : "");
			$("#phone").css("outline", (!$("#phone").val().match(/(\+7|8)\d{10}/)) ? "1px solid #A80000" : "none");
			$(".errorCheckbox").html((!$("#politik").prop('checked')) ? "Для продолжения регистрации необходимо ознакомиться с политикой безопасности" : "");
			$("input:radio:hidden[name=gender]").parent().parent().parent().find(".blockErrorReg").html($("input:radio:hidden:checked[name=gender]").val() == null ? "Не указан пол" : "");
			$("#birthday").parent().parent().parent().find(".blockErrorReg").html(($("#birthday").val() == '' || new Date() - new Date($("#birthday").val()) < 0) ? "Неверно указана дата рождения" : "");
			$("#birthday").css("outline", ($("#birthday").val() == '' || new Date() - new Date($("#birthday").val()) < 0) ? "1px solid #A80000" : "none");
		} else{
			$(".contentRegistration").css('filter', 'grayscale(1)');
			$("#regBut").prop('disabled', true);
			$.ajax({
				url: "registration/php/registration.php",
				data: $("#registrationFormPHP").serialize(),
				type: 'POST',
				success:function(result){
					switch(result){
						case "1": {
							$("#email").parent().parent().parent().find(".blockErrorReg").html("Пользователь с такой электронной почтой уже зарегистрирован");
							$("#email").css("outline", "1px solid #A80000");
							$(".contentRegistration").css('filter', 'grayscale(0)');
							$("#regBut").prop('disabled', false);
							break;
						}
						case "2": {
							$(".confirmEmailText").html("На электронную почта " + $("#email").val() + " было отправлено письмо. Для подтверждения регистрации перейдите по ссылке в письме.")
							$(".contentRegistration").hide();
							$(".confrimEmail").show();
							break;
						}
					}
				}
			});
		}
	});