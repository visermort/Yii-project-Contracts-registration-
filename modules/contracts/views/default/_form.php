<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\contracts\models\Contracts */
/* @var $form yii\widgets\ActiveForm */

$this->registerJsFile('/assets/customjs/custom.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<div class="contracts-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- <?= $form->field($model, 'date')->textInput() ?> -->
    <? if ($model->isNewRecord):?>
      <?= $form->field($model, 'date')->textInput(['value' => date('Y-m-d')]) ?>
    <? else :?>
      <?= $form->field($model, 'date')->textInput() ?>
    <? endif; ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'passport')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'manufacturer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'model')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'imei')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'percent')->textInput(['maxlength' => true, 'readonly' => true]) ?>

    <?= $form->field($model, 'sum')->textInput(['readonly' => true]) ?>

 <!--    <?= $form->field($model, 'sale_point')->textInput(['maxlength' => true]) ?> -->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
