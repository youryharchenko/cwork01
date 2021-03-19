<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\KindsOfPurchase;

/* @var $this yii\web\View */
/* @var $searchModel app\models\KindsOfPurchaseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kinds Of Purchases';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kinds-of-purchase-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Kinds Of Purchase', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'description',
            'created_at',
            'updated_at',
            [
                'attribute' => 'status',
                'value' => 'statusText',
                'filter' => KindsOfPurchase::$statusList,
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
