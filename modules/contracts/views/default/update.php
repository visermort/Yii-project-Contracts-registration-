<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\contracts\models\Contracts */

$this->title = 'Update Contract: ' . '#'.$model->id.' from '.$model->date;
$this->params['breadcrumbs'][] = ['label' => 'Contracts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => '#'.$model->id.' from '.$model->date, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="contracts-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
