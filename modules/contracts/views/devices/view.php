<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\contracts\models\Devices */

$this->title = $model->emai;
$this->params['breadcrumbs'][] = ['label' => 'Devices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="devices-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'model',
            'emai',
            'manufacturer',
            'price',
        ],
    ]) ?>

</div>
