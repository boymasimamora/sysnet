<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\ServiceReport $model
 */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Service Report',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Service Reports'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-report-create">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
