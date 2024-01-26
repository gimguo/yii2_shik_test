<?php

use frontend\models\Order;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Menu;

/** @var yii\web\View $this */
/** @var app\models\search\OrderSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">
    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <?php
                echo Menu::widget([
                    'items' => $searchModel->menuArrayItems(),
                ]);
                ?>
            </div>
            <div class="col-lg-8">
                <h1><?= Html::encode($this->title) ?></h1>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        'created_at',
                        'sum',
                    ],
                ]); ?>
            </div>
        </div>

    </div>
</div>
