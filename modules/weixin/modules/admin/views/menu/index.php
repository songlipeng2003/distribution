<?php
$this->title = '自定义菜单';
?>
<div ng-app="myApp">
    <div class="" ng-controller="menuDesigner">
        <div class="panel panel-default">
            <div class="panel-heading">
                菜单设计器 <span class="text-muted">编辑和设置公众号菜单, 必须自定义菜单权限。</span>
            </div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <tbody class="designer ui-sortable">
                        <tr class="hover" ng-repeat="menu in menus">
                            <td>
                                <div>
                                    <input type="hidden" data-role="parent" data-hash="{{menu.$$hashKey}}" />
                                    <input type="text" class="form-control" style="display:inline-block;width:300px;" ng-model="menu.title"> &nbsp; &nbsp;
                                    <a href="javascript:;" class="fa fa-arrows" title="拖动调整此菜单位置"></a> &nbsp;
                                    <a href="javascript:;" ng-click="setAction(menu);" class="fa fa-edit" title="设置此菜单动作"></a> &nbsp;
                                    <a href="javascript:;" ng-click="deleteMenu(menu)" class="fa fa-times-circle" title="删除此菜单"></a> &nbsp;
                                    <a href="javascript:;" ng-click="addSubMenu(menu);" title="添加子菜单" class="fa fa-plus-circle"></a>
                                </div>
                                <div class="designer">
                                    <div ng-repeat="sub in menu.subMenus" style="margin-top:20px;padding-left:80px;background:url('/images/bg_repno.gif') no-repeat -245px -545px;">
                                        <input type="hidden" data-role="sub" data-hash="{{sub.$$hashKey}}" />
                                        <input type="text" class="form-control" style="display:inline-block;width:220px;" ng-model="sub.title"> &nbsp; &nbsp;
                                        <a href="javascript:;" class="fa fa-arrows" title="拖动调整此菜单位置"></a> &nbsp;
                                        <a href="javascript:;" ng-click="setAction(sub);" class="fa fa-edit" title="设置此菜单动作"></a> &nbsp;
                                        <a href="javascript:;" ng-click="deleteMenu(menu, sub);" class="fa fa-times-circle" title="删除此菜单"></a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="panel-footer">
                <a href="javascript:;" ng-click="addMenu();">添加菜单 <i class="fa fa-plus-circle" title="添加菜单"></i></a> &nbsp; &nbsp; &nbsp;  <span class="help-inline">可以使用 <i class="fa fa-arrows"></i> 进行拖动排序</span>
            </div>
        </div>

        <?php if(!empty($menuLastModify)){ ?>
        <div class="panel panel-success">
            <div class="panel-heading">
                历史记录菜单 <span class="text-muted">最后一次编辑时间：<?php echo strftime('%Y-%m-%d %H:%M:%S', $menuLastModify) ?> <b><a href="javascript:;" onclick="$('.history-body').fadeToggle();$('.history-foot').fadeToggle();">点击展示</a></b></span>
            </div>
            <div class="table-responsive history-body">
                <table class="table table-hover">
                    <tbody class="designer ui-sortable">
                        <tr class="hover ng-scope" ng-repeat="hmenu in hmenus">
                            <td>
                                <div>
                                    <input type="hidden" data-role="parent" data-hash="004">
                                    <input type="text" class="form-control ng-pristine ng-valid" readonly="" style="display:inline-block;width:300px;" ng-model="hmenu.title"> &nbsp; &nbsp;
                                </div>
                                <div class="designer">
                                    <div ng-repeat="sub in hmenu.subMenus" style="margin-top:20px;padding-left:80px;background:url('/images/bg_repno.gif') no-repeat -245px -545px;">
                                        <input type="hidden" data-role="sub" data-hash="{{sub.$$hashKey}}" />
                                        <input type="text" class="form-control" style="display:inline-block;width:220px;" ng-model="sub.title" readonly> &nbsp; &nbsp;
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="panel-footer history-foot">
                <a href="javascript:;" ng-click="useHistory();" class="btn btn-success">使用历史菜单</a>
            </div>
        </div>
        <?php } ?>

        <div class="panel panel-default">
            <div class="panel-heading">
                操作 <span class="text-muted">设计好菜单后再进行保存操作</span>
            </div>
            <div class="panel-body">
                <div class="form form-horizontal">
                    <div class="form-group">
                        <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
                            <input type="button" value="保存菜单结构" class="btn btn-primary" ng-click="saveMenu();">
                            <span class="help-block">菜单设计完成将在所有支持的公众号上生效. 成功保存当前菜单结构至公众平台后, 由于缓存可能需要在24小时内生效</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
                            <input type="button" value="删除" class="btn btn-primary" ng-click="removeMenu();">
                            <div class="help-block">清除自定义菜单</div>
                        </div>
                    </div>
                </div>
                <div id="dialog" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <h3 class="ng-binding">选择菜单 【未命名菜单】 要执行的操作</h3>
                            </div>
                            <div class="modal-body">
                                <label class="radio-inline">
                                    <input type="radio" name="ipt" ng-model="activeMenu.type" value="url" checked="checked" class="ng-pristine ng-valid"> 链接
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="ipt" ng-model="activeMenu.type" value="forward" class="ng-pristine ng-valid"> 模拟关键字
                                </label>
                                <hr>
                                <div ng-show="activeMenu.type == 'url';" class="ng-hide">
                                    <input class="form-control ng-pristine ng-valid" id="ipt-url" type="text" ng-model="activeMenu.url">
                                    <span class="help-block">指定点击此菜单时要跳转的链接（注：链接需加http://）
                                    <a href="javascript:;" ng-click="select_link()" class="hide"><i class="fa fa-external-link"></i> 选择系统链接</a>
                                    </span>
                                    <span class="help-block"><strong>注意: 由于接口限制. 如果你没有网页oAuth接口权限, 这里输入链接直接进入微站个人中心时将会有缺陷(有可能获得不到当前访问用户的身份信息. 如果没有oAuth接口权限, 建议你使用图文回复的形式来访问个人中心)</strong></span>
                                </div>
                                <div ng-show="activeMenu.type == 'forward';" style="position:relative" class="ng-hide">
                                    <div class="input-group">
                                        <input class="form-control ng-pristine ng-valid" id="ipt-forward" type="text" ng-model="activeMenu.forward">
                                        <!--
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary" id="search" ng-click="search()"><i class="icon-search"></i> 搜索</button>
                                        </div>
                                    -->
                                    </div>
                                    <div id="key-result" style="width:100%;position:absolute;top:32px;left:0px;display:none;z-index:10000">
                                      <ul class="dropdown-menu" style="display:block;width:91%;"></ul>
                                    </div>
                                    <span class="help-block">指定点击此菜单时要执行的操作, 你可以在这里输入关键字, 那么点击这个菜单时就就相当于发送这个内容至系统</span>
                                    <span class="help-block"><strong>这个过程是程序模拟的, 比如这里添加关键字: 优惠券, 那么点击这个菜单是, 微擎系统相当于接受了粉丝用户的消息, 内容为"优惠券"</strong></span>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <a href="javascript:;" ng-click="saveMenuAction();" class="pull-right btn btn-primary span2" data-dismiss="modal">保存</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script type="text/javascript">
var hmenus = <?= $menu ? $menu : '[]'; ?>;
</script>
<?php 
$this->registerJsFile('/js/weixin/util.js', ['depends' => [
    \yii\web\JqueryAsset::className(),
]]);
$this->registerJsFile('/js/weixin/menu.js', ['depends' => [
    \yii\web\JqueryAsset::className(),
    \app\assets\UnderscoreAsset::className(),
    \dee\angular\AngularAsset::className(),
    \yii\jui\JuiAsset::className(),
    \rmrevin\yii\fontawesome\AssetBundle::className()
]]);
?>