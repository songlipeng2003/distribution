$(function(){
    $('#nav-qrcode').click(function(){
        $.getJSON('/shop/user/spread', function(){
            $('#qrcode-alert').modal();
        });
    });

});