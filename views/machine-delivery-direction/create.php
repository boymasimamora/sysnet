<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\MachineDeliveryDirection $model
 */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Machine Delivery Direction',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Machine Delivery Directions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="machine-delivery-direction-create">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
