angular.module('myApp', []).controller('menuDesigner', function($scope, $http){
    $scope.menus = [];
    $scope.hmenus = hmenus;
    $scope.activeMenu = {};
    
    $scope.addMenu = function() {
        if($scope.menus.length >= 3) {
            return;
        }
        $scope.menus.push({
            title: '',
            type: 'url',
            url: '',
            forward: '',
            subMenus: []
        });
        $('.designer').sortable({handle: '.fa-arrows'});
    };
    $scope.addSubMenu = function(menu) {
        if(menu.subMenus.length >= 5) {
            return;
        }
        menu.subMenus.push({
            title: '',
            type: 'url',
            url: '',
            forward: ''
        });
        $('.designer').sortable({handle: '.fa-arrows'});
    };
    $scope.deleteMenu = function(menu, sub) {
        if(sub) {
            menu.subMenus = _.without(menu.subMenus, sub);
        } else {
            if(menu.subMenus.length > 0 && !confirm('将同时删除所有子菜单, 是否继续? ')) {
                return;
            }
            $scope.menus = _.without($scope.menus, menu);   
        }
    };
    $scope.setAction = function(menu) {
        $scope.activeMenu = menu;
        if(!$scope.activeMenu.url) {
            $scope.activeMenu.url = 'http://';
        }
        var header = "选择菜单 【{{activeMenu.title || '未命名菜单'}}】 要执行的操作";
        var content = $("#url").html();
        var menu = util.dialog(header, content, 'queee');
        
        $('#dialog').modal('show');
    };
    $scope.saveMenuAction = function(){
        $('#dialog').modal('hide');
    };
    $scope.useHistory = function(){
        $scope.menus = $scope.hmenus;
    }
    $scope.saveMenu = function(version){
        var menus = $scope.menus;
        var hmenus = $scope.hmenus;
        /*如果使用历史记录菜单，则不对表单进行判断*/
        if (version != 'history') {
            if (menus.length < 1) {
                util.message('请您至少输入一个自定义菜单.', '', 'error');
                return ;
            }
            if(menus.length > 3) {
                util.message('不能输入超过 3 个主菜单才能保存.', '', 'error');
                return;
            }
            var error = {empty: false, message: ''};
            angular.forEach(menus, function(val){
                if(val.subMenus.length > 0) {
                    angular.forEach(val.subMenus, function(v){
                        if($.trim(v.title) == '') {
                            this.empty = true;
                        }
                        if((v.type == 'url' && $.trim(v.url) == '') || (v.type == 'forward' && $.trim(v.forward) == '')) {
                            this.message += '菜单【' + val.title + '】的子菜单【' + v.title + '】未设置操作选项. <br />';
                        }
                    }, error);
                } else {
                    if((val.type == 'url' && $.trim(val.url) == '') || (val.type == 'forward' && $.trim(val.forward) == '')) {
                        this.message += '菜单【' + val.title + '】不存在子菜单并且未设置操作选项. <br />';
                    }
                }
                
                if($.trim(val.title) == '') {
                    this.empty = true;
                }
            }, error)
            if(error.empty) {
                util.message('存在未输入名称的菜单.', '', 'error');
                return;
            }
            if(error.message) {
                util.message(error.message, '', 'error');
                return;
            }
        }
        
        var params = {};
        params.menus = _.sortBy($scope.menus, function(i){
            var elm = $(':hidden[data-role="parent"][data-hash="' + i.$$hashKey + '"]');
            return elm.parent().parent().parent().index();
        });
        angular.forEach(params.menus, function(i){
            i.subMenus = _.sortBy(i.subMenus, function(j){
                var e = $(':hidden[data-role="sub"][data-hash="' + j.$$hashKey + '"]');
                return e.parent().index();
            });
        });
        params.menus = angular.copy(params.menus);
        params.method = 'save';
        if (version == 'history') {
            params.menus = _.sortBy($scope.hmenus, function(i){
                var elm = $(':hidden[data-role="parent"][data-hash="' + i.$$hashKey + '"]');
                return elm.parent().parent().parent().index();
            });
            angular.forEach(params.menus, function(i){
                i.subMenus = _.sortBy(i.subMenus, function(j){
                    var e = $(':hidden[data-role="sub"][data-hash="' + j.$$hashKey + '"]');
                    return e.parent().index();
                });
            });
            params.type = version;
            params.menus = angular.copy(params.menus);
            $http.post('/weixin/admin/menu/save', params).success(function(data, status){
                if(data.result != 0) {
                    util.message(dat.message, '', 'error');
                } else {
                    util.message('菜单保存成功. ', location.href);
                }
            });
            return;
        }
        $http.post('/weixin/admin/menu/save', params).success(function(data, status){
            if(data != 0) {
                util.message(dat.message, '', 'error');
            } else {
                util.message('菜单保存成功. ', location.href);
            }
        });
        return;
        $('#do').val(ret.data);
        $('#form')[0].submit();
    };
    
    $scope.removeMenu = function(){
        $http.post('/weixin/admin/menu/delete').success(function(dat, status){
            if(dat != 'success') {
                util.message(dat.message, '', 'error');
            } else {
                util.message('清除自定义菜单成功. ', location.href);
            }

        });
    };
    
    //点击选择【系统连接】事件
    $scope.select_link = function(){
        var ipt = $(this).parent().prev();
        util.linkBrowser(function(href){
            var site_url = "http://w.com/";
            if(href.substring(0, 4) == 'tel:') {
                util.message('自定义菜单不能设置为一键拨号');
                return;
            } else if(href.indexOf("http://") == -1 && href.indexOf("https://") == -1) {
                href = site_url + 'app' + href;
            }
            $scope.activeMenu.url = href;
            $scope.$digest();
        });
    };

    $scope.search = function(){
        var search_value = $('#ipt-forward').val();
        $.post("./index.php?c=platform&a=menu&do=search_key&", {'key_word' : search_value}, function(data){
            var data = $.parseJSON(data);
            var total = data.length;
            var html = '';
            if(total > 0) {
                for(var i = 0; i < total; i++) {
                    html += '<li><a href="javascript:;">' + data[i] + '</a></li>';
                }
            } else {
                html += '<li><a href="javascript:;" id="no-result">没有找到您输入的关键字</a></li>';
            }
            $('#key-result ul').html(html);
            $('#key-result ul li a[id!="no-result"]').click(function(){
                $('#ipt-forward').val($(this).html());
                $scope.activeMenu.forward = $(this).html();
                $('#key-result').hide();
            });
            $('#key-result').show();
        });
    }
});

$(function(){
    $('.designer').sortable({handle: '.fa.fa-arrows'});
    $('#dialog').modal({backdrop: 'static', keyboard: false, show: false});

    $('#ipt-forward').keydown(function(event){
        if(event.keyCode == 13){
            $('#search').click();
        }
    });
    $('#dialog').click(function(event){
        var clickid = $(event.target).attr('id');
        if(clickid != 'key-result' && clickid != 'ipt-forward'  && clickid != 'search') {
            $('#key-result').hide();
            return;
        }
    });
    
});