<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\contracts\models\Contracts */

$this->title = '#'.$model->id.' from '.$model->date;
$this->params['breadcrumbs'][] = ['label' => 'Contracts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contracts-view">

    <h1><?= Html::encode($this->title) ?></h1>
<? /*?>
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
            
        <?= Html::a('Print', ['print', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

    </p>
<?*/?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'date',
            'name',
            'passport',
            'phone',
            'manufacturer',
            'model',
            'imei',
            'price',
            'percent',
            'sum',
           // 'sale_point',
        ],
    ]) ?>
    <p>
        <?= Html::a('Print contract', ['print', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

    </p>


</div>
