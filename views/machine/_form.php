<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\datecontrol\DateControl;

/**
 * @var yii\web\View $this
 * @var app\models\Machine $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="machine-form">

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_HORIZONTAL]); echo Form::widget([

    'model' => $model,
    'form' => $form,
    'columns' => 1,
    'attributes' => [

'brand'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Brand...', 'maxlength'=>50]], 

'model'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Model...', 'maxlength'=>50]], 

    ]


    ]);
    echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
    ActiveForm::end(); ?>

</div>
