<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Norm;
use app\models\Department;
use app\models\KindsOfPurchase;

/* @var $this yii\web\View */
/* @var $model app\models\Norm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="norm-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'kind_id')->dropDownList(KindsOfPurchase::getAll() , ['prompt'=>'Select Kinds']);  ?>

    <?= $form->field($model, 'department_id')->dropDownList(Department::getAll() , ['prompt'=>'Select Department']); ?>

    <?= $form->field($model, 'year')->textInput() ?>

    <?= $form->field($model, 'month')->textInput() ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>
    <!--
    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>
    -->

    <?= $form->field($model, 'status')->dropDownList(Norm::$statusList, ['prompt'=>'Select Status']);  ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
