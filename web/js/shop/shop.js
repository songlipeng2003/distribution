$(function(){
    $('.yii-debug-toolbar_position_bottom').hide();

    $('#nav-qrcode').click(function(){
        $.getJSON('/shop/user/spread', function(){
            $('#qrcode-alert').modal();
        });
    });

    $('#user-nav').on('open.collapse.amui', function() {
      $('#user-collapase .am-icon-angle-up').toggle();
      $('#user-collapase .am-icon-angle-down').toggle();
    }).on('close.collapse.amui', function() {
      $('#user-collapase .am-icon-angle-up').toggle();
      $('#user-collapase .am-icon-angle-down').toggle();
    });
});