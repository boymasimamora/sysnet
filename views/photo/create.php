<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Photo $model
 */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Photo',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Photos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="photo-create">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
