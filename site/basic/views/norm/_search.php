<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Norm;
use app\models\Department;
use app\models\KindsOfPurchase;

/* @var $this yii\web\View */
/* @var $model app\models\NormSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="norm-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'kind_id')->dropDownList(KindsOfPurchase::getAll() , ['prompt'=>'Select Kinds']);   ?>

    <?= $form->field($model, 'department_id')->dropDownList(Department::getAll() , ['prompt'=>'Select Department']); ?>

    <?= $form->field($model, 'year') ?>

    <?= $form->field($model, 'month') ?>

    <?= $form->field($model, 'amount') ?>

    <?= $form->field($model, 'created_at') ?>

    <?= $form->field($model, 'updated_at') ?>

    <?= $form->field($model, 'status')->dropDownList(Norm::$statusList, ['prompt'=>'Select Status']); ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
