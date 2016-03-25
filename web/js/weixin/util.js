var util = {};

util.dialog = function(title, content, footer, options) {
    if(!options) {
        options = {};
    }
    if(!options.containerName) {
        options.containerName = 'modal-message';
    }
    var modalobj = $('#' + options.containerName);
    if(modalobj.length == 0) {
        $(document.body).append('<div id="' + options.containerName + '" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true"></div>');
        modalobj = $('#' + options.containerName);
    }
    html = 
        '<div class="modal-dialog">'+
        '   <div class="modal-content">';
    if(title) {
        html +=
        '<div class="modal-header">'+
        '   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>'+
        '   <h3>' + title + '</h3>'+
        '</div>';
    }
    if(content) {
        if(!$.isArray(content)) {
            html += '<div class="modal-body">'+ content + '</div>';
        } else {
            html += '<div class="modal-body">正在加载中</div>';
        }
    }
    if(footer) {
        html +=
        '<div class="modal-footer">'+ footer + '</div>';
    }
    html += '   </div></div>';
    modalobj.html(html);
    if(content && $.isArray(content)) {
        var embed = function(c) {
            modalobj.find('.modal-body').html(c);
        };
        if(content.length == 2) {
            $.post(content[0], content[1]).success(embed);
        } else {
            $.get(content[0]).success(embed);
        }
    }
    return modalobj;
};

util.message = function(msg, redirect, type){
    if(!redirect && !type){
        type = 'info';
    }
    if($.inArray(type, ['success', 'error', 'info', 'warning']) == -1) {
        type = '';
    }
    if(type == '') {
        type = redirect == '' ? 'error' : 'success';
    }
    
    var icons = {
        success : 'check-circle',
        error :'times-circle',
        info : 'info-circle',
        warning : 'exclamation-triangle'
    };
    var p = '';
    if(redirect && redirect.length > 0){
        if(redirect == 'back'){
            p = '<p>[<a href="javascript:;" onclick="history.go(-1)">返回上一页</a>] &nbsp; [<a href="./?refresh">回首页</a>]</p>';
        }else{
            p = '<p><a href="' + redirect + '" target="main" data-dismiss="modal" aria-hidden="true">如果你的浏览器在 <span id="timeout"></span> 秒后没有自动跳转，请点击此链接</a></p>';
        }
    }
    var content = 
        '           <i class="pull-left fa fa-4x fa-'+icons[type]+'"></i>'+
        '           <div class="pull-left"><p>'+ msg +'</p>' +
        p +
        '           </div>'+
        '           <div class="clearfix"></div>';
    var footer = 
        '           <button type="button" class="btn btn-default" data-dismiss="modal">确认</button>';
    var modalobj = util.dialog('系统提示', content, footer, {'containerName' : 'modal-message'});
    modalobj.find('.modal-content').addClass('alert alert-'+type);
    if(redirect) {
        var timer = '';
        timeout = 3;
        modalobj.find("#timeout").html(timeout);
        modalobj.on('show.bs.modal', function(){doredirect();});
        modalobj.on('hide.bs.modal', function(){timeout = 0;doredirect(); });
        modalobj.on('hidden.bs.modal', function(){modalobj.remove();});
        function doredirect() {
            timer = setTimeout(function(){
                if (timeout <= 0) {
                    modalobj.modal('hide');
                    clearTimeout(timer);
                    window.location.href = redirect;
                    return;
                } else {
                    timeout--;
                    modalobj.find("#timeout").html(timeout);
                    doredirect();
                }
            }, 1000);
        }
    }
    modalobj.modal('show');
    return modalobj;
};