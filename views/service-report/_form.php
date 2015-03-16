<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\datecontrol\DateControl;

/**
 * @var yii\web\View $this
 * @var app\models\ServiceReport $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="service-report-form">

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_HORIZONTAL]); echo Form::widget([

    'model' => $model,
    'form' => $form,
    'columns' => 1,
    'attributes' => [

'submit_date'=>['type'=> Form::INPUT_WIDGET, 'widgetClass'=>DateControl::classname(),'options'=>['type'=>DateControl::FORMAT_DATE]], 

'reported_by'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Reported By...', 'maxlength'=>50]], 

'report_detail'=>['type'=> Form::INPUT_TEXTAREA, 'options'=>['placeholder'=>'Enter Report Detail...','rows'=> 6]], 

    ]


    ]);
    echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
    ActiveForm::end(); ?>

</div>
