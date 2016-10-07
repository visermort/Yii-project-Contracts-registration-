<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\modules\contracts\models\Clients;
use app\modules\contracts\models\Devices;

/* @var $this yii\web\View */
/* @var $model app\modules\contracts\models\Contracts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contracts-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'date')->textInput(['value' => date('Y-m-d')]) ?>

  <!--   <?= $form->field($model, 'client_id')->textInput() ?> -->

    <?= $form->field($model, 'client_id')->dropDownList(
    	ArrayHelper::map(Clients::find()->all(), 'id', 'fullName')
    )?>

  <!-- <?= $form->field($model, 'device_id')->textInput() ?> -->

   <?= $form->field($model, 'device_id')->dropDownList(
    	ArrayHelper::map(Devices::find()->all(), 'id', 'fullName')
    )?>

   <!--  <?= $form->field($model, 'summa')->textInput(['maxlength' => true]) ?> -->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
