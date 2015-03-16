<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\RequestStatus $model
 */

$this->title = Yii::t('app', 'Follow Up Request', [
    'modelClass' => 'Request Status',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Request Statuses'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="request-status-create">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
