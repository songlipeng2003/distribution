<?php 
use app\assets\EmployeeAsset;

EmployeeAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
    <title>吃货榜样</title>
    <?php $this->head() ?>
</head>
<body ng-app="employee">
<?php $this->beginBody() ?>
    <ion-nav-bar class="bar-stable nav-title-slide-ios">
        <ion-nav-back-button class="button-icon icon ion-ios-arrow-back">
            返回
        </ion-nav-back-button>
    </ion-nav-bar>
    <ion-nav-view animation="slide-left-right"></ion-nav-view>
    <script id="templates/form-errors.html" type="text/ng-template">
        <div class="form-error" ng-message="required">必须填写.</div>
        <div class="form-error" ng-message="minlength">长度太短了</div>
        <div class="form-error" ng-message="maxlength">长度太长了</div>
    </script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
