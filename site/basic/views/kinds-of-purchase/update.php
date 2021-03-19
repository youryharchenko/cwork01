<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\KindsOfPurchase */

$this->title = 'Update Kinds Of Purchase: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Kinds Of Purchases', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kinds-of-purchase-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
