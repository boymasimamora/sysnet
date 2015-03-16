<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\MaterialForMachineTesting $model
 */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Material For Machine Testing',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Material For Machine Testings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="material-for-machine-testing-create">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
