<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Contoh $model
 */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Contoh',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Contohs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contoh-create">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
