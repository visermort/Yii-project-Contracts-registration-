<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

        <?= $form->field($model, 'password')->passwordInput() ?>
  
        <?= $form->field($model, 'salePoint')->dropDownList(['',
            '01 Dep Chisinau Bd. Ștefan cel Mare 71' => '01 Dep Chisinau Bd. Ștefan cel Mare 71'  ,
            '02 Dep Chisinau Str. Independentei 13' => '02 Dep Chisinau Str. Independentei 13',
            '04 Dep Chisinau Str. Arborilor 21' => '04 Dep Chisinau Str. Arborilor 21',
            '07 Dep Chisinau Bd Stefan cel Mare 128/1' => '07 Dep Chisinau Bd Stefan cel Mare 128/1',
            '09 Dep Chisinau Str. A. Russo 1/1' => '09 Dep Chisinau Str. A. Russo 1/1',
            '10 Dep Chisinau Str. Dacia 23' => '10 Dep Chisinau Str. Dacia 23',
            '11 Dep Chisinau Str. Bucuriei 1/6' => '11 Dep Chisinau Str. Bucuriei 1/6',
            '27 Dep Chisinau str. Kiev 16/1' => '27 Dep Chisinau str. Kiev 16/1',
            '30 Dep Orhei Str. Vasile Lupu 37' => '30 Dep Orhei Str. Vasile Lupu 37',
            '31 Dep Comrat Str. Lenin 178' => '31 Dep Comrat Str. Lenin 178',
            '32 Dep Balti Piaţa Vasile Alecsandri 4' => '32 Dep Balti Piaţa Vasile Alecsandri 4',
            '36 Dep Edinet Str. 31 August 1989, 11' => '36 Dep Edinet Str. 31 August 1989, 11',
            '37 Dep Drochia Str. 31 August 1989, 33' => '37 Dep Drochia Str. 31 August 1989, 33',
            '38 Dep Straseni Str. M. Eminescu 25' => '38 Dep Straseni Str. M. Eminescu 25',
            '39 Dep Cahul Str. Republicii 20/11' => '39 Dep Cahul Str. Republicii 20/11',
            '40 Dep Causeni Str. M. Eminescu 12' => '40 Dep Causeni Str. M. Eminescu 12',
            '41 Dep Balti Bd. Ștefan cel Mare 37'=> '41 Dep Balti Bd. Ștefan cel Mare 37',
            '42 Dep Soroca Str. Grigore Vieru 5' => '42 Dep Soroca Str. Grigore Vieru 5',
            '43 Dep Hancesti Str. Chisinaului 10A' => '43 Dep Hancesti Str. Chisinaului 10A',
            '47 Dep Ungheni Str. Nationala 15' => '47 Dep Ungheni Str. Nationala 15',
            '51 Dep Glodeni Str. Suveranitatii 17/2' => '51 Dep Glodeni Str. Suveranitatii 17/2',
            '52 Dep Ceadar-Lunga Str. Lenin 79' => '52 Dep Ceadar-Lunga Str. Lenin 79',
            '53 Dep Calarasi Str. M. Eminescu 23' => '53 Dep Calarasi Str. M. Eminescu 23',
        ])?>


<!--         <?= $form->field($model, 'rememberMe')->checkbox([
            'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
        ]) ?>
 -->
        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

</div>


