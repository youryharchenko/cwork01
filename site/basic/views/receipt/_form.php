<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Receipt;
use app\models\Employee;
use app\models\Norm;

/* @var $this yii\web\View */
/* @var $model app\models\Receipt */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="receipt-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'norm_id')->dropDownList(Norm::getCurr() , ['prompt'=>'Select Norm']); ?>

    <?= $form->field($model, 'employee_id')->dropDownList(Employee::getCurr() , ['prompt'=>'Select Employee']); ?>

    <?= $form->field($model, 'date')->textInput(['value' => date('Y.m.d')]) ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
    <!--
    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>
    -->
    <?= $form->field($model, 'status')->dropDownList(Receipt::$statusList, ['prompt'=>'Select Status']);  ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
