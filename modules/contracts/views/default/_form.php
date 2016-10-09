<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\modules\contracts\models\Clients;
use app\modules\contracts\models\Devices;

/* @var $this yii\web\View */
/* @var $model app\modules\contracts\models\Contracts */
/* @var $form yii\widgets\ActiveForm */
$this->registerJsFile('/assets/customjs/custom.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<div class="buttons" style="margin-bottom: 15px;">
  <button class="btn btn-primary " data-toggle="modal" data-target="#clientModal">
        Выбрать клиента
  </button>
    <button class="btn btn-primary " data-toggle="modal" data-target="#diviceModal">
        Выбрать Устройство
  </button>

</div>
<div class="contracts-form">

    <?php $form = ActiveForm::begin(); ?>


    <? if ($model->isNewRecord):?>
      <?= $form->field($model, 'date')->textInput(['value' => date('Y-m-d')]) ?>
    <? else :?>
      <?= $form->field($model, 'date')->textInput() ?>
    <? endif; ?>
    
  <?= $form->field($model, 'client_id')->hiddenInput(['readonly' => true,]) ?>
   <input type="text" id="client_fullname" class="form-control" readonly value="<?=Clients::find()->where(['id' => $model->client_id])->one()->fullName?>" style="margin-bottom: 15px; margin-top: -15px;"> 


<!--   <div class="form-group field-contracts-client_id required">
    <label class="control-label" for="contracts-client_id">Клиент</label>
      <input type="hidden" id="contracts-client_id" class="form-control" name="Contracts[client_id]" readonly>
      <input type="text" id="client_fullname" class="form-control" readonly>
    <div class="help-block"></div>
  </div> --> 

 <? /*?>  <?= $form->field($model, 'client_id')->dropDownList(
    	ArrayHelper::map(Clients::find()->all(), 'id', 'fullName')
    )?>
   <?= $form->field($model, 'device_id')->textInput() ?> <? */?>

  <? /*?> <?= $form->field($model, 'device_id')->dropDownList(
    	ArrayHelper::map(Devices::find()->all(), 'id', 'fullName')
    )?><? */ ?>

  <?= $form->field($model, 'device_id')->hiddenInput(['readonly' => true,]) ?>
  <input type="text" id="device_fullname" class="form-control" readonly value="<?=Devices::find()->where(['id' => $model->device_id])->one()->fullName?>" style="margin-bottom: 15px; margin-top: -15px;"> 

<!--   <div class="form-group field-contracts-divice_id required">
    <label class="control-label" for="contracts-device_id">Устройство</label>
      <input type="hidden" id="contracts-device_id" class="form-control" name="Contracts[device_id]" readonly>
      <input type="text" id="device_fullname" class="form-control" readonly>
    <div class="help-block"></div>
  </div> -->  

   <?= $form->field($model, 'summa')->textInput(['maxlength' => true, 'readonly' => true,] ) ?> 


  <div class="form-group">
      <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
  </div>

    <?php ActiveForm::end(); ?>

</div>


<!-- Modal Clients-->
<div class="modal fade" id="clientModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="clientModalLabel">Выберите клиента</h4>
      </div>
      <div class="modal-body">
        <div class="clients">
          <p>
              <?= Html::a('Новый клиент', '/contracts/clients/create', ['class' => 'btn btn-success']) ?>
          </p>
            <?php Pjax::begin(); ?>    <?= GridView::widget([
                    'dataProvider' => $clientDataProvider,
                    'filterModel' => $clientSearchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        //'id',
                        'name',
                        'birth',
                        'passport',
                        [
                          'class' => 'yii\grid\ActionColumn',
                          'template' => '{choose}',
                          'buttons' =>[
                            'choose' =>function ($url,$model,$key) {
                              return Html::button('Выбрать',[
                                'class' => 'btn btn-primary btn-client-choose',
                                'data' => [
                                    'id' => $model->id,
                                    'fullname' => $model->fullName,

                                  ],
                                ]);
                            },
                          ],
                        ],
                    ],
                ]); ?>
            <?php Pjax::end(); ?>
        </div>

      </div>
    </div>
  </div>
</div>
<!-- Modal devices-->
<div class="modal fade" id="diviceModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="deviceModalLabel">Выберите устройство</h4>
      </div>
      <div class="modal-body">
        <div class="devices">
          <p>
              <?= Html::a('Новое устройство', '/contracts/devices/create', ['class' => 'btn btn-success']) ?>
          </p>
            <?php Pjax::begin(); ?>    <?= GridView::widget([
                    'dataProvider' => $deviceDataProvider,
                    'filterModel' => $deviceSearchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        //'id',
                        'model',
                        'emai',
                        'manufacturer',
                        'price',
                        [
                          'class' => 'yii\grid\ActionColumn',
                          'template' => '{choose}',
                          'buttons' =>[
                            'choose' =>function ($url,$model,$key) {
                              return Html::button('Выбрать',[
                                'class' => 'btn btn-primary btn-device-choose',
                                'data' => [
                                    'id' => $model->id,
                                    'fullname' => $model->fullName,
                                    'summa' => $model->summa,
                                  ],
                                ]);
                            },
                          ],
                        ],
                    ],
                ]); ?>
            <?php Pjax::end(); ?>
        </div>

      </div>
    </div>
  </div>
</div>

