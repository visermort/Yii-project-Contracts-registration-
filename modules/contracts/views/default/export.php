<?php

use yii\helpers\Html;
//use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\contracts\models\Contracts */

$this->title = 'Export';
$this->params['breadcrumbs'][] = ['label' => 'Contracts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contracts-view"x>

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        Contracts exported to  <a target="_blank" href="https://drive.google.com/drive/my-drive" >Google Drive</a>
    </p>


</div>
