<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '系统信息';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title">系统信息</h3>
    </div>
    <div class="panel-body">
        <table class="table table-hover">
            <tbody>
                <tr>
                    <th style="width: 300px;">系统版本</th>
                    <td><?= $params['system'] ?></td>
                </tr>
                <tr>
                    <th>PHP版本</th>
                    <td><?= $params['phpVersion'] ?></td>
                </tr>
                <tr>
                    <th>服务器软件</th>
                    <td><?= $params['server'] ?></td>
                </tr>
                <tr>
                    <th>MySQL版本</th>
                    <td><?= $params['mysql'] ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>