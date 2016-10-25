<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\contracts\models\Contracts */
/* @var $form yii\widgets\ActiveForm */

$this->registerJsFile('/assets/customjs/custom.js', ['depends' => [\yii\web\JqueryAsset::className()]]);


//тарифы по умолчанию и для определённых моделей
$devices = [
    'default' => [
        'label' => '',
        'data' => [
                '0' => ['val' => '0', 'text' => ''],
                '2000' => ['val' => '.14', 'text' => '14 (paisprezece)'],
                '5000' => ['val' => '.12', 'text' => '12 (douăsprezece)'],
                '15000' => ['val' => '.10', 'text' => '10 (zece)'],
            ],

        ],
    'samsung_s6' => [
        'label' => 'Samsung S6',
        'data' => [
                '0' => ['val' => '0', 'text' => ''],
                '2000' => ['val' => '.20', 'text' => '20 (paisprezece)'],
                '5000' => ['val' => '.18', 'text' => '18 (douăsprezece)'],
                '15000' => ['val' => '.16', 'text' => '16 (zece)'],
            ],

        ],
    'samsung_s6_edge' => [
        'label' => 'Samsung S6 Edge',
        'data' => [
                '0' => ['val' => '0', 'text' => ''],
                '2000' => ['val' => '.25', 'text' => '25 (paisprezece)'],
                '5000' => ['val' => '.22', 'text' => '22 (douăsprezece)'],
                '15000' => ['val' => '.20', 'text' => '20 (zece)'],
            ],

        ],


    ];

?>

<div class="contracts-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- <?= $form->field($model, 'date')->textInput() ?> -->
    <? if ($model->isNewRecord):?>
      <?= $form->field($model, 'date')->textInput(['value' => date('Y-m-d'), 'readonly' => true]) ?>
    <? else :?>
      <?= $form->field($model, 'date')->textInput(['readonly' => true]) ?>
    <? endif; ?>

    <span

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'passport')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'manufacturer')->textInput(['maxlength' => true]) ?>


    <div class="form-group field-contracts-passport required">
        <label class="control-label" for="devisec-search">Model - Select from proposed models</label>
        <select id="devices-search" class="form-control">
            <?php foreach ($devices as $key => $device) : ?>
                <option value="<?=$device['label']?>" data-tax='<?php echo json_encode($device['data']); ?>'>
                    <?=$device['label']?>
                </option>
            <?php endforeach;?>
        </select>
    <div class="help-block"></div>
    </div>

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
