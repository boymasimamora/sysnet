<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\datecontrol\DateControl;

/**
 * @var yii\web\View $this
 * @var app\models\RequestStatus $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript">
	$( document ).ready(function() {
		$(".field-requeststatus-followed_up_by_id").hide();
	});
</script>

<div class="request-status-form">

    <?php 
    $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_HORIZONTAL]); 
    // date_default_timezone_set(Yii::$app->modules['datecontrol']['displayTimezone']);
    // $datetime_now = date('d/M/Y H:i:s', time());

    $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_HORIZONTAL]); echo Form::widget([

    'model' => $model,
    'form' => $form,
    'columns' => 1,
    'attributes' => [

//'follow_up_date'=>['type'=> Form::INPUT_TEXT, 'options'=>[/*'type'=>DateControl::FORMAT_DATETIME*/'readonly'=>true, 'value'=>$datetime_now]], 

'followed_up_by_id'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Followed Up By ID...', 'readonly'=>true, 'value'=>Yii::$app->user->id]], 

'notes'=>['type'=> Form::INPUT_TEXTAREA, 'options'=>['placeholder'=>'Enter Notes...','rows'=> 6]], 

    ]


    ]);
    echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
    ActiveForm::end(); ?>

</div>
