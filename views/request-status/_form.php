<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\datecontrol\DateControl;

use kartik\widgets\Select2;
use a3ch3r46\tinymce\TinyMCE;
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
        $(".field-requeststatus-technician").hide();
	});

    function changeTechnician()
    {
        var obj = $("#s2id_requeststatus-technician").select2("data");
        //alert(obj[0]["text"]);
        var total = (JSON.parse(JSON.stringify(obj))).length;
        //alert(total);   
        var emails = '';
        for(var i=0; i<total; i++)
        {
            emails += obj[i]["text"];
            if(i<total-1){ emails += ',';}
        }
        $("#technicianEmails").val(emails);
        //document.getElementById('requeststatus-technician').value = "emails";
    }

    function fungsi()
    {
        alert($("#technicianEmails").val());
    }
</script>

<div class="request-status-form">
    <!-- <button onclick="fungsi()">asd</button> -->

    <?php 

    echo '<div class="row">';
    echo '<div class="form-group" style="display:block;">';
    echo '<label for="requeststatus-technician" class="col-md-2 control-label" style="text-align:right;">Technician</label>';
    echo '<div class="col-md-10">';

        $connection = Yii::$app->db;
        $qry = $connection->createCommand('SELECT DISTINCT email 
                        FROM (
                                    SELECT u.email, a.item_name, a.user_id 
                                    FROM user AS u, auth_assignment AS a
                                    WHERE u.id = a.user_id AND a.item_name LIKE "%echnicia%"
                              ) 
                        AS email_tujuan')->queryAll();
        $total = count($qry);
        $email_addresses = array();
        for($i = 0; $i<$total; $i++)
        {
            $email_addresses[$i] = $qry[$i]["email"];
            // $email_addresses = $email_addresses."'".$qry[$i]["email"]."'";
            // if($i<$total-1) { $email_addresses = $email_addresses . ','; }
        }

        $data = $email_addresses;
        // $data = ['technician1@gmail.com', 'technician2@gmail.com', 'technician3@gmail.com'];
        //echo '<label class="control-label">Provinces</label>';
        echo Select2::widget([
            'model' => $model,
            'attribute' => 'technician',
            'data' => $data,
            'options' => [
                'class'=>'form-control',
                'placeholder' => '--Select Technician--',
                'multiple'=>true,
            ],
            'pluginEvents'=> [
                "change" => "function() { changeTechnician(); }",
            ]
        ]);
        echo '</br>';

    echo '</div>';
    echo '</div>';
    echo '</div>';
    ?>

    <!-- <div class="row" id="emailsdiv">
        <div class="col-sm-12">
            <div class="form-group field-requeststatus-technician">
                <label class="col-md-2 control-label" for="requeststatus-technician">Technician</label>
                <div class="col-md-10">
                    <textarea id="technicianEmails2" class="form-control" placeholder="Enter All Technician Emails (ex: abc@syspex.com, def@syspex.com)" rows="6" name="RequestStatus[technician]"></textarea>
                </div>
                <div class="col-md-offset-2 col-md-10">
                    <div class="help-block"></div>
                </div>
            </div>
        </div>
    </div> -->

    <?php   

    $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_HORIZONTAL]); echo Form::widget([

    'model' => $model,
    'form' => $form,
    'columns' => 1,
    'attributes' => [

//'follow_up_date'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Follow Up Date...', 'maxlength'=>50]], 

'followed_up_by_id'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Followed Up By ID...', 'readonly'=>true, 'value'=>Yii::$app->user->id]], 

'scheduled_date'=>['type'=> Form::INPUT_WIDGET, 'widgetClass'=>DateControl::classname(), 'options'=>['type'=>DateControl::FORMAT_DATE, 'saveTimezone'=>Yii::$app->modules['datecontrol']['displayTimezone']]], 

'technician'=>['type'=> Form::INPUT_TEXTAREA, 'options'=>['placeholder'=>'Input All Technician Emails (ex: abc@syspex.com, def@syspex.com)','rows'=> 6, 'id'=>'technicianEmails']], 

'notes'=>['type'=> Form::INPUT_WIDGET, 'widgetClass'=>TinyMCE::classname(), 'options'=>['placeholder'=>'Enter Notes...','rows'=> 6, 'height'=>50, 'toolbar'=>['bold italic','alignleft aligncenter alignright alignjustify','bullist numlist outdent indent',], 'menubar'=>false]], 

//'status'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Status...']], 

//'status'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Status...']], 



    ]


    ]);
    echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
    ActiveForm::end(); ?>

</div>
