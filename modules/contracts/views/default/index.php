<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\User;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\contracts\models\SearchContracts */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contracts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contracts-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Contract', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php if (Yii::$app->user->identity->role == User::ROLE_ADMIN)
        {
            $views = '{view}{update}{delete}';
        } else {
            $views = '{view}';
        }?>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'date',
            'name',
            'passport',
            'phone',
            'manufacturer',
            'model',
            'imei',
            'price',
           // 'percent',
            'tariff',
            'sum',
            'salePoint',
            //'fullName',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => $views,//'{view} ',
            ],
          //  ['class' => 'yii\grid\ActionColumn'],

            ],
    ]); ?>
<?php Pjax::end(); ?></div>
