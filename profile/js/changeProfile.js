krestik = "<img src='/icons/krestik.svg' width=20px>"
	$("#inputFileAvatar").change(function(e){
		rAva = $("#resultAvatar");
		rAva.html('Пожалуйста подождите...<img src="/gif/loading.gif" style="width:30px;">');
		rAva.addClass("mediumTextBlack").removeClass("mediumTextRed").removeClass("mediumTextGreen").removeClass("hiddenClass");
		var form_data = new FormData();
		form_data.append('file', $('#inputFileAvatar').prop('files')[0]);
		if($('#inputFileAvatar').prop('files')[0].size <= 524288){
			$.ajax({
				url: 'php/avatar.php',
				dataType: 'text',
				data: form_data,
				contentType: false,
				processData: false,
				type: 'post',
				success: function(result){
					if(result == '0' || result =='1' || result == '2' || result == '3')
						rAva.addClass("mediumTextRed").removeClass("mediumTextBlack").removeClass("mediumTextGreen");
					else{
						rAva.addClass("mediumTextGreen").removeClass("mediumTextBlack").removeClass("mediumTextRed");
						var reader = new FileReader();
						reader.onload = function(e){
							$("#imgAvatar").attr('src', e.target.result);
						}
						reader.readAsDataURL($('#inputFileAvatar').prop('files')[0]);
					}
					switch(result){
						case '0':{ rAva.html('Необходимо выбрать изображение формата JPG или PNG'+krestik); break; }
						case '1':{ rAva.html('Размер изображения не должен привышать 512кБ'+krestik); break; }
						case '2':{ rAva.html('Ошибка данных об пользователе'+krestik); break; }
						case '3':{ rAva.html('Произошла ошибка на сервере'+krestik); break; }
						case '4':{ rAva.html('Изображение успешно обновлено<img src="/icons/galochka.svg" style="width:20px; margin-left: 5px;">'); break; }
					}
				}
			});
		}
		else{
			rAva.addClass("mediumTextRed").removeClass("mediumTextBlack").removeClass("mediumTextGreen");
			rAva.html('Размер изображения не должен привышать 512кБ'+krestik);
		}
	});
	$("input").focusout(function(e){
		inputD = $("#" + e.target.id);
		switch(e.target.id){
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
	$("#changeProfileButton").click(function(e){
		if($("#fam").val().length < 3 || $("#im").val().length < 3 || !$("#phone").val().match(/^[\+*7]{2}\d{10}$|^[8]\d{10}$/) ||
		$("input:radio:hidden:checked[name=gender]").val() == null || $("#birthday").val() == '' || new Date() - new Date($("#birthday").val()) < 0
		){
			$("#fam").parent().parent().parent().find(".blockErrorReg").html(($("#fam").val() == null || $("#fam").val().length < 3) ? "Неверно указана фамилия" : "");
			$("#fam").css("outline", ($("#fam").val() == null || $("#fam").val().length < 3) ? "1px solid #A80000" : "none");
			$("#im").parent().parent().parent().find(".blockErrorReg").html(($("#im").val() == null || $("#im").val().length < 3) ? "Неверно указано имя" : "");
			$("#im").css("outline", ($("#im").val() == null || $("#im").val().length < 3) ? "1px solid #A80000" : "none");
			$("#phone").parent().parent().parent().find(".blockErrorReg").html((!$("#phone").val().match(/^[\+*7]{2}\d{10}$|^[8]\d{10}$/)) ? "Неверно указан номер телефона" : "");
			$("#phone").css("outline", (!$("#phone").val().match(/(\+7|8)\d{10}/)) ? "1px solid #A80000" : "none");
			$("input:radio:hidden[name=gender]").parent().parent().parent().find(".blockErrorReg").html($("input:radio:hidden:checked[name=gender]").val() == null ? "Не указан пол" : "");
			$("#birthday").parent().parent().parent().find(".blockErrorReg").html(($("#birthday").val() == '' || new Date() - new Date($("#birthday").val()) < 0) ? "Неверно указана дата рождения" : "");
			$("#birthday").css("outline", ($("#birthday").val() == '' || new Date() - new Date($("#birthday").val()) < 0) ? "1px solid #A80000" : "none");
		} else{
			rAva = $("#resultChangeProfile");
			rAva.html('Пожалуйста подождите...<img src="/gif/loading.gif" style="width:30px;">');
			rAva.addClass("mediumTextBlack").removeClass("mediumTextRed").removeClass("mediumTextGreen").removeClass("hiddenClass");
			$.ajax({
				url: "php/changeProfile.php",
				data: $("#cProf").serialize(),
				type: 'POST',
				success:function(result){
					if(result == '0' || result =='1' || result == '2')
						rAva.addClass("mediumTextRed").removeClass("mediumTextBlack").removeClass("mediumTextGreen");
					else
						rAva.addClass("mediumTextGreen").removeClass("mediumTextBlack").removeClass("mediumTextRed");
					switch(result){
						case '0':{ rAva.html('Неверно указаны данные'+krestik); break; }
						case '1':{ rAva.html('Ошибка данных об пользователе'+krestik); break; }
						case '2':{ rAva.html('Произошла ошибка на сервер'+krestik); break; }
						case '3':{ rAva.html('Данные успешно сохранены<img src="/icons/galochka.svg" style="width:20px; margin-left: 5px;">'); break; }
					}
				}
			});
		}
	});