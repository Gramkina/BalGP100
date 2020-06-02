$(".SettingsProfileElement").click(function(e){
    val = $(this).attr('href');
    $(".SettingsProfileElement").removeClass("SettingsProfileElementSelectedItem");
    $(this).addClass("SettingsProfileElementSelectedItem");
    $('title').text(val == 'changeprofile' ? 'Личный кабинет - Редактирование' : val == 'changepassword' ? 'Личный кабинет - Смена пароля' : val == 'devices' ? 'Личный кабинет - Устройства' : val == 'zapisi' ? 'Личный кабинет - Мои записи' : '');
    $('.path').html("<span><a href='/'>Главная</a> • <a href='/profile'>Личный кабинет</a> • <a href='/profile/"+val+".php'>"+(val == 'changeprofile' ? 'Редактирование' : val == 'changepassword' ? 'Смена пароля' : val == 'devices' ? 'Устройства' : val == 'zapisi' ? 'Мои записи' : '')+"</a></span>");
    history.pushState("", "", "/profile/"+val+".php");
    $(".newContent").remove();
    $(".nextContent").toggleClass("hiddenClass");
    $.get('templates/'+val+'.php', function(result){
        $(".nextContent").toggleClass("hiddenClass");
        $('.mainDiv').append(result);
    });	
});