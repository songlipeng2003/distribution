<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

use kucha\ueditor\UEditor;

use app\assets\UploadifyAsset;
use app\models\Product;
use app\models\Category;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin([
        'layout' => 'horizontal',
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group field-product-price required">
        <label class="control-label col-sm-3" for="product-price">图片</label>
        <div class="col-sm-6">
            <div id="images" class="row">
                <?php foreach ($model->getImages() as $image) {
                    if($image){ ?>
                    <div class="col-sm-3 thumbnail" data-image-id="<?= $image->id ?>">
                        <img src="<?= $image->getUrl('300px') ?>" alt="">
                    </div>
                <?php 
                    }
                } 
                ?>
            </div>
            <button type="button" id="file-upload" class="btn btn-default">上传</button>
        </div>
    </div>

    <?= $form->field($model, 'categoryId')->dropdownList(ArrayHelper::map(Category::find()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'originalPrice')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'quantity')->textInput() ?>

    <?= $form->field($model, 'status')->dropdownList(Product::$statuses) ?>

    <?= $form->field($model, 'content')->widget(UEditor::className(), []) ?>

    <div class="form-group">
        <div class="col-lg-offset-3 col-lg-11">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php 
$this->registerJsFile('/js/admin/product.js', ['depends' => [
    UploadifyAsset::className(),
]]);
?>