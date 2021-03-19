<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Receipt;
use app\models\Employee;
use app\models\Norm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ReceiptSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Receipts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="receipt-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Receipt', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'norm_id',
                'value' => 'normName',
                'filter' => Norm::getAll(),
            ],
            [
                'attribute' => 'employee_id',
                'value' => 'employeeName',
                'filter' => Employee::getAll(),
            ],
            'date',
            'amount',
            'description',
            'created_at',
            'updated_at',
            [
                'attribute' => 'status',
                'value' => 'statusText',
                'filter' => Receipt::$statusList,
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
