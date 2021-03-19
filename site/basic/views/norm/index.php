<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Norm;
use app\models\Department;
use app\models\KindsOfPurchase;

/* @var $this yii\web\View */
/* @var $searchModel app\models\NormSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Norms';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="norm-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Norm', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'kind_id',
                'value' => 'kindName',
                'filter' => KindsOfPurchase::getAll(),
            ],
            [
                'attribute' => 'department_id',
                'value' => 'departmentName',
                'filter' => Department::getAll(),
            ],
            'year',
            'month',
            'amount',
            'created_at',
            'updated_at',
            [
                'attribute' => 'status',
                'value' => 'statusText',
                'filter' => Norm::$statusList,
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
