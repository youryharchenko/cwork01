<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\KindsOfPurchase;


/* @var $this yii\web\View */
/* @var $model app\models\KindsOfPurchase */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kinds-of-purchase-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
    <!--
    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>
    -->
    <?= $form->field($model, 'status')->dropDownList(KindsOfPurchase::$statusList, ['prompt'=>'Select Status']);?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
