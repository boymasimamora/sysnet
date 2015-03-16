<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\RequestType $model
 */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Request Type',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Request Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-type-create">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
