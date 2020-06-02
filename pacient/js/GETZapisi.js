nedelya = 0;
$(function(){
    $('#contentStep2').removeClass('visibileObject');
    $('body').animate({scrollTop: $('.stepZapisDiv2').offset().top}, 1000);
    getRaspisanie();
})
$('body').on('click', '.nextNedel', function(){
    $('#step2NextButton').hide();
    getRaspisanie(++nedelya);
});
$('body').on('click', '.predNedel', function(){
    if(nedelya != 0){
        getRaspisanie(--nedelya);
        $('#step2NextButton').hide();
    }
});
function getRaspisanie(){
    doctor = $('#selectDoctor').find('option:selected').attr('card');
    var today = new Date();
    today.setDate(today.getDate()+7*nedelya);
    var date = today.getDate()+'.'+(today.getMonth()+1)+'.'+today.getFullYear();
    $.post('php/getRaspisanieDoctor.php', {doctor: doctor, date: date}, function(result){
        $('#resultRaspisanie').removeClass('resultRaspisanieGif');
        $('#resultRaspisanie').html(result);
    })
}
$('body').on('click', '.selectTimeRaspisanieDiv', function(){
    $('.selectedTimeRaspisanieDiv').removeClass('selectedTimeRaspisanieDiv').addClass('selectTimeRaspisanieDiv');
    $(this).addClass('selectedTimeRaspisanieDiv');
    if($('#step2NextButton').prop('hidden') == true) $('#step2NextButton').show();
    $('body').animate({scrollTop: $('#step2NextButton').offset().top}, 1000);
})
$('#step2NextButton').click(function(){
    time = $('.selectedTimeRaspisanieDiv').attr('time');
    doctor = $('#selectDoctor').find('option:selected').attr('card');
    date = $('.selectedTimeRaspisanieDiv').attr('date');
    $.post('php/addZapis.php', {doctor: doctor, time: time, date: date}, function(result){
        if(result == 1){
            $('.step2input1').html('<div class="mediumTextBlack">Дата приема - '+date+' в '+time+'</div><img src="/icons/galochka.svg">');
            $('#step2NextButton').prop('disabled', 'true');
            $('#resultRaspisanie').empty();
            $('.stepZapisDiv2').append('<img src="/icons/galochka.svg">').children('div.selectStepZapisDiv.largeTextWhite').removeClass('selectStepZapisDiv').addClass('disabledStepZapisDiv');
            $('#contentStep3').removeClass('visibileObject');
            $('body').animate({scrollTop: $('#contentStep3').offset().top}, 1000);
        }
    })
})
$('#step3NextButton').click(function(){
    $.post('php/verification.php', {code: $('#codeVer').val()}, function(result){
        if(result == 3){
            $('.mainDiv').empty();
            $('.mainDiv').append('<div class="congratulation"><img src="/icons/happy_icon.svg"><div class="largeTextBlack">Вы успешно записались на прием.</div></div>');
        }
        else{
            $('.resultCode').html(result);
        }
    })
});