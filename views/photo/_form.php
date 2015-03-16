<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\datecontrol\DateControl;

/**
 * @var yii\web\View $this
 * @var app\models\Photo $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="photo-form">

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_HORIZONTAL]); echo Form::widget([

    'model' => $model,
    'form' => $form,
    'columns' => 1,
    'attributes' => [

'caption'=>['type'=> Form::INPUT_TEXTAREA, 'options'=>['placeholder'=>'Enter Caption...','rows'=> 6]], 

'album_id'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Album ID...']], 

'path'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Path...', 'maxlength'=>100]], 

'title'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Title...', 'maxlength'=>100]], 

    ]


    ]);
    echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
    ActiveForm::end(); ?>

</div>
