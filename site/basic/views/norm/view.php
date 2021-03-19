<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Norm */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Norms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="norm-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'kind_id',
                'value' => $model->kindName,
            ],
            [
                'attribute' => 'department_id',
                'value' => $model->departmentName,
            ],
            'year',
            'month',
            'amount',
            'created_at',
            'updated_at',
            [
                'attribute' => 'status',
                'value' => $model->statusText,
            ],
        ],
    ]) ?>

</div>
