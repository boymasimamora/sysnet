<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Machine $model
 */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Machine',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Machines'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="machine-create">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
