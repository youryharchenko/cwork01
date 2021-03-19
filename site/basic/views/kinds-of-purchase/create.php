<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\KindsOfPurchase */

$this->title = 'Create Kinds Of Purchase';
$this->params['breadcrumbs'][] = ['label' => 'Kinds Of Purchases', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kinds-of-purchase-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
