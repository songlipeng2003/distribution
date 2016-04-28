$(function(){
    $('.yii-debug-toolbar_position_bottom').hide();

    $('.op-qrcode').click(function(){
        var modal = $('#loading').modal();

        $.getJSON('/shop/user/spread', function(data){
            var msg;
            if(data.result==0){
                msg = '你的专属推广海报已发送！请前往眯糊时光查看';
            }else{
                msg = data.msg;
            }

            $('#alert-msg').text(msg);

            modal.modal('close');

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