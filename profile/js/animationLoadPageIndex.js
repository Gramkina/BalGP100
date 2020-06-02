$(".mainMenuProfileElement").one('click', function(e){
    val = $(this).attr('href');
    $(".SettingsProfileElement[href="+val+"]").addClass("SettingsProfileElementSelectedItem");
    d1 = true;
    d2 = true;
    $(".mainMenuProfileElementCircle").css('animation-play-state', 'paused');
    $(".mainMenuProfileElement").playKeyframe({name: 'mainMenuProfileElementChange', duration: '1s', timingFunction: 'ease', complete: function(){
        if(d1){
            d1 = false;
            $(".contentDefault").remove();
            $(".menuSetting").show();
            $('title').text(val == 'changeprofile' ? 'Личный кабинет - Редактирование' : val == 'changepassword' ? 'Личный кабинет - Смена пароля' : val == 'devices' ? 'Личный кабинет - Устройства' : val == 'zapisi' ? 'Личный кабинет - Мои записи' : '');
            $('.path').html("<span><a href='/'>Главная</a> • <a href='/profile'>Личный кабинет</a> • <a href='/profile/"+val+".php'>"+(val == 'changeprofile' ? 'Редактирование' : val == 'changepassword' ? 'Смена пароля' : val == 'devices' ? 'Устройства' : val == 'zapisi' ? 'Мои записи' : '')+"</a></span>");
            history.pushState("", "", "/profile/"+val+".php");
            $(".menuSetting").playKeyframe({name: 'menuLeftAnim', duration: '1s', timingFunction: 'ease', complete: function(){
                if(d2){
                    d2 = false;
                    $(".mainDiv").toggleClass("disFlex");
                    $(".nextContent").toggleClass("hiddenClass");
                    $.get('templates/'+val+'.php', function(result){
                        $(".nextContent").toggleClass("hiddenClass");
                        $('.mainDiv').append(result);
                    });	
                }			
            }});
        }
    }});
});