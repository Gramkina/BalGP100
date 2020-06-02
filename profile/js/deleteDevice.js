$(".removeDevice").click(function(e){
    $.post("php/deleteDevice.php", {token:$(this).attr('token'), series:$(this).attr('series')}, function(result){
        alert(result);
    });
});