$(function(){
    $('.yii-debug-toolbar_position_bottom').hide();

    $('#nav-qrcode').click(function(){
        $.getJSON('/shop/user/spread', function(){
            $('#qrcode-alert').modal();
        });
    });

});