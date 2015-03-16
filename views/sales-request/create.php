<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\SalesRequest $model
 */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Sales Request',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sales Requests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sales-request-create">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
