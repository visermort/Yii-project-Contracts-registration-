<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\contracts\models\Contracts */

$this->title = 'Update Contracts: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Contracts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="contracts-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'clientSearchModel' => $clientSearchModel,
        'clientDataProvider' => $clientDataProvider,
        'deviceSearchModel' => $deviceSearchModel,
        'deviceDataProvider' => $deviceDataProvider,
    ]) ?>

</div>
