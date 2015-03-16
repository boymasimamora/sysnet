<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\datecontrol\DateControl;
use yii\helpers\ArrayHelper;
use kartik\widgets\DepDrop;

use kartik\widgets\Select2;
use yii\web\JsExpression;
use kartik\widgets\TouchSpin;
use a3ch3r46\tinymce\TinyMCE;

/**
 * @var yii\web\View $this
 * @var app\models\SalesRequest $model
 * @var yii\widgets\ActiveForm $form
 */
?>
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript">
	$( document ).ready(function() {
		//console.log( "ready!" );
		var currentdate = new Date(); 

		var datetime = currentdate.getFullYear() + "-"
	            + (currentdate.getMonth()+1)  + "-" 
	            + currentdate.getDate() + " "  
	            + currentdate.getHours() + ":"  
	            + currentdate.getMinutes() + ":" 
	            + currentdate.getSeconds();
	    //$('#salesrequest-submit_date-disp').val(datetime);
	    var typeval = $('#input_request_type').val();
	    document.getElementById('customer-address').disabled = true;
	    changeForm(typeval);

	    $('#salesrequest-customer_contact_person').focus(function(){
	    	if($('#select2-chosen-1').val() == '')
	    	{
	    		//alert('nih');
	    	}
	    });

	    $("#customer-address").blur(function () {
	    	var cust_name = $("#customer-name").val();
	    	var cust_address = $("#customer-address").val();

	    	if(cust_address != '')
	    	{
	    		if(confirm('Are you sure you want to save this customer data?'))
	    		{	
	    			$.ajax({    
		                type:"POST",
		                url:"<?php echo Yii::$app->urlManager->createUrl('/sales-request/addcustomer'); ?>",
		                data:"cust="+cust_name+"&address="+cust_address,
		                //contentType: "application/json; charset=utf-8",
		                dataType:"json",
		            }).done(function(data){
		                    var hasil = data.result[0].id;
		                    $("#select2-chosen-1").text(hasil);
		                    //$("#select2-chosen-1").val(hasil);
		                    $("#salesrequest-customer_id").val(hasil);
		                    $("#tempcustomer").val(hasil);

		                    //$("#select2-chosen-1").val(hasil);
		            });	
	    		}
	    		else
	    		{
	    			setTimeout(function(){document.getElementById("customer-address").focus();}, 1);	
	    		}	    		
	    	}
	    	else
	    	{
	    		alert('Please fill customer address!');
	    		setTimeout(function(){document.getElementById("customer-address").focus();}, 1);	
	    	}
	    	// alert($("#select2-chosen-1").text());
	    	
		    //alert("hello");
		    //alert(this.value);
		    /*if(!this.value)
		    {
		    	alert('Please fill the customer name');
		    	$(this).click();
		    }*/
		    
		});

		$('#customer-name').keyup(function(){
			if($(this).val() != '')
			{
				document.getElementById('customer-address').disabled = false;
			}
			else
			{
				document.getElementById('customer-address').disabled = true;
			}
		});

		$('#customer-name').blur(function(){
			var name = $(this).val();
			if(name == '')
			{
				alert('You have to fill customer name first!');
				setTimeout(function(){document.getElementById("customer-name").focus();}, 1);
			}
		});

	});
	

	

	function valuechanged(req){
		changeForm(req.value);
	}

	function changeForm(nilai){
		//alert(req.value);
		showAll();
		if(nilai == 1)
		{
			newMachineInstallation();
		}
		else if(nilai == 2)
		{
			rental();
		}
		else if(nilai == 3)
		{
			demo();
		}
		else if(nilai == 4)
		{
			onCallRepair();
		}
		else if(nilai == 5)
		{
			technicalAssistant();
		}
		else
		{
			hideAll();
		}
		// alert($("#salesrequest-customer_id").val());
	}

	function showAll(){
		$(".form-group").show();
		$(".field-salesrequest-request_status_id").hide();
		$(".field-salesrequest-submit_by_id").hide();
		$("#tempcustomer").hide();

		if($("#flagCustomer").val() == "1") {
		 	$(".field-salesrequest-customer_id").hide(); 
		}
		else{  
			$(".field-customer-name").hide();
			$(".field-customer-address").hide();
			// $(".field-salesrequest-customer_contact_person").hide();
			// $(".field-salesrequest-customer_contact_number").hide();
		}
	}

	function hideAll(){
		$(".form-group").hide();
		$(".field-salesrequest-submit_date").show();
		$(".field-salesrequest-request_type_id").show();
		$(".salesrequest_display_only").show();
		$(".field-salesrequest-customer_id").show();
		$(".field-salesrequest-customer_contact_person").show();
		$(".field-salesrequest-customer_contact_number").show();
	}

	function newMachineInstallation(){
		$( ".field-salesrequest-period_of_rental" ).hide();
		$( ".field-salesrequest-period_of_demo" ).hide();
		$( ".field-salesrequest-problem_report_by_customer").hide();
		$( ".field-salesrequest-purpose").hide();
		$(".field-salesrequest-duration").hide();
	}

	function rental(){
		$(".field-salesrequest-machine_delivery_direction_id").hide();
		$(".field-salesrequest-main_power_supply").hide();
		$(".field-salesrequest-foc_item").hide();
		$(".field-salesrequest-warranty_term_from_supplier").hide();
		$(".field-salesrequest-warranty_term_to_customer").hide();
		$(".field-salesrequest-free_service").hide();
		$(".field-salesrequest-total_free_service_per_year").hide();
		$(".field-salesrequest-period_of_demo").hide();
		$(".field-salesrequest-problem_report_by_customer").hide();
		$(".field-salesrequest-purpose").hide();
		$(".field-salesrequest-duration").hide();
	}

	function demo(){
		$(".field-salesrequest-machine_delivery_direction_id").hide();
		$(".field-salesrequest-main_power_supply").hide();
		$(".field-salesrequest-foc_item").hide();
		$(".field-salesrequest-warranty_term_from_supplier").hide();
		$(".field-salesrequest-warranty_term_to_customer").hide();
		$(".field-salesrequest-free_service").hide();
		$(".field-salesrequest-total_free_service_per_year").hide();
		$(".field-salesrequest-period_of_rental").hide();
		$(".field-salesrequest-problem_report_by_customer").hide();
		$(".field-salesrequest-purpose").hide();
	}

	function onCallRepair(){
		$(".field-salesrequest-machine_arrival_date_estimation").hide();
		$(".field-salesrequest-delivery_date_request").hide();
		$(".field-salesrequest-installation_date_request").hide();
		$(".field-salesrequest-machine_delivery_direction_id").hide();
		$(".field-salesrequest-main_power_supply").hide();
		$(".field-salesrequest-customer_product_details").hide();
		$(".field-salesrequest-material_for_machine_testing_id").hide();
		$(".field-salesrequest-material_specification_details").hide();
		$(".field-salesrequest-machine_accessories").hide();
		$(".field-salesrequest-special_requirement").hide();
		$(".field-salesrequest-foc_item").hide();
		$(".field-salesrequest-warranty_term_from_supplier").hide();
		$(".field-salesrequest-warranty_term_to_customer").hide();
		$(".field-salesrequest-free_service").hide();
		$(".field-salesrequest-total_free_service_per_year").hide();
		$(".field-salesrequest-period_of_rental").hide();
		$(".field-salesrequest-period_of_demo").hide();
		$(".field-salesrequest-purpose").hide();
		$(".field-salesrequest-duration").hide();
	}

	function technicalAssistant(){
		$(".field-salesrequest-machine_arrival_date_estimation").hide();
		$(".field-salesrequest-delivery_date_request").hide();
		$(".field-salesrequest-installation_date_request").hide();
		$(".field-salesrequest-machine_delivery_direction_id").hide();
		$(".field-salesrequest-main_power_supply").hide();
		$(".field-salesrequest-customer_product_details").hide();
		$(".field-salesrequest-material_for_machine_testing_id").hide();
		$(".field-salesrequest-material_specification_details").hide();
		$(".field-salesrequest-machine_accessories").hide();
		$(".field-salesrequest-special_requirement").hide();
		$(".field-salesrequest-foc_item").hide();
		$(".field-salesrequest-warranty_term_from_supplier").hide();
		$(".field-salesrequest-warranty_term_to_customer").hide();
		$(".field-salesrequest-free_service").hide();
		$(".field-salesrequest-total_free_service_per_year").hide();
		$(".field-salesrequest-period_of_rental").hide();
		$(".field-salesrequest-period_of_demo").hide();
		$(".field-salesrequest-problem_report_by_customer").hide();
		$(".field-salesrequest-additional_comments").hide();
		$(".field-salesrequest-duration").hide();
		$(".field-salesrequest-machine_type").hide();
	}

	
</script>
<div class="sales-request-form">
	<!-- <button onclick="aduh()">asdf</button> -->
	<form id="w0" class="form-horizontal" >
		<fieldset id="w2">
			<div class="form-group salesrequest_display_only">
				<label class="col-md-2 control-label">Requestor</label>
				<div class="col-md-10">
					<input id="salesrequest_display_only" class="form-control" type="text" disabled="" value="<?php echo Yii::$app->user->identity->username." (".Yii::$app->user->identity->email.")"; ?>">
				</div>
				<div class="col-md-offset-2 col-md-10"></div>
				<div class="col-md-offset-2 col-md-10">
					<div class="help-block"></div>
				</div>
			</div>
		</fieldset>
	</form>

	<script type="text/javascript">
		function addNewCustomer()
		{
			$("#flagCustomer").val("1");
			$(".field-salesrequest-customer_id").hide();
			$("#select2-drop").hide();
			$(".field-customer-name").show();
			$(".field-customer-address").show();
			//$(".field-customer-contact_person").show();
			//$(".field-customer-contact_number").show();

			$(".field-salesrequest-customer_contact_person").show();
			$(".field-salesrequest-customer_contact_number").show();

			//document.getElementById("customer-address").disabled = true;
			document.getElementById("customer-name").focus();
		}
	</script>

    <?php 
    $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_HORIZONTAL]); 
    date_default_timezone_set(Yii::$app->modules['datecontrol']['displayTimezone']);
    //$datetime_now = date('d/M/Y H:i:s', time());

    $url = \yii\helpers\Url::to(['customerlist']);


// Script to initialize the selection based on the value of the select2 element
$initScript = <<< SCRIPT
function (element, callback) {
	var id=\$(element).val();
	if (id !== "") {
		\$.ajax("{$url}?id=" + id, {
		dataType: "json"
		}).done(function(data) {
			callback(data.results);
		});
	}
}
SCRIPT;
    //echo $datetime_now;
	echo $form->field($model, 'customer_id')->widget(Select2::classname('tes'), [
		'options' => ['placeholder' => 'Search for a Customer ...'],
		'pluginOptions' => [
			'allowClear' => true,
			'minimumInputLength' => 1,
			'ajax' => [
				'url' => $url,
				'dataType' => 'json',
				'data' => new JsExpression('function(term,page) { return {search:term}; }'),
				'results' => new JsExpression('function(data,page) { 
					if(data.results != 0) { 
						$("#salesrequest-customer_id").val(data.results[0]["id"]); 
					}
					else {}
					return {results:data.results}; 
				}'),
			],
			'initSelection' => new JsExpression($initScript),
			'formatNoMatches'=>'No matches found. Click here to <a href="" onclick="addNewCustomer();">add new Customer</a>',
		],
		'pluginEvents' => [
			"change" => 'function(data) { 
				var data_id = data.added["id"];
				$("#salesrequest-customer_id").val(data_id);
			}',
		],
	]);
?>

	<div class="row">
		<div class="col-sm-12">
			<div class="form-group field-customer-name required">
				<label class="col-md-2 control-label" for="customer-name">Customer Name</label>
				<div class="col-md-10">
					<input id="customer-name" class="form-control" type="text" placeholder="Enter Name..." maxlength="100" name="Customer[name]">
				</div>
				<div class="col-md-offset-2 col-md-10">
					<div class="help-block"></div>
				</div>
			</div>
		</div>
	</div>

	<input style="display:none;" id="flagCustomer" value="0"></input>

	<div class="row">
		<div class="col-sm-12">
			<div class="form-group field-customer-address">
				<label class="col-md-2 control-label" for="customer-address">Customer Address</label>
				<div class="col-md-10">
					<textarea id="customer-address" class="form-control" placeholder="Enter Address..." rows="6" name="Customer[address]"></textarea>
				</div>
				<div class="col-md-offset-2 col-md-10">
					<div class="help-block"></div>
				</div>
			</div>
		</div>
	</div>

	<div class="row" id="tempcustomer">
		<div class="col-sm-12">
			<div class="form-group field-salesrequest-customer_id" style="display: block;">
				<label class="col-md-2 control-label" for="salesrequest-customer_id">Customer</label>
				<div class="col-md-10">
					<input id="salesrequest-customer_id" class="form-control" type="text" prompt="--Select Customer--" name="SalesRequest[customer_id]">
				</div>
				<div class="col-md-offset-2 col-md-10">
					<div class="help-block"></div>
				</div>
			</div>
		</div>
	</div>

<?php 
	date_default_timezone_set(Yii::$app->modules['datecontrol']['displayTimezone']);
    echo Form::widget([
    'model' => $model,
    'form' => $form,
    'columns' => 1,
    'attributes' => [

'submit_by_id'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Submit By ID...', 'readonly'=>false, 'value'=>Yii::$app->user->id]], 
	'customer_contact_person'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Contact Person Name...', 'maxlength'=>50]], 
	'customer_contact_number'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Contact Number...', 'maxlength'=>50]], 
//'submit_date'=>['type'=> Form::INPUT_TEXT, 'options'=>['readonly'=>true, 'value'=>$datetime_now]], 

'request_type_id'=>['type'=> Form::INPUT_DROPDOWN_LIST, 'options'=>['id'=>'input_request_type', 'prompt'=>'--Select Request Type--', 'onchange'=>'valuechanged(this);'],'items'=>$model->requestTypeList], 


//'customer_id'=>['type'=> Form::INPUT_TEXT, 'options'=>['prompt'=>'--Select Customer--', 'readonly'=>false]], 
/*[
	//'format'=>'raw',
	'value' => function ($data){
		return echo $form->field($model, 'id')->widget(Select2::classname(), [
			'options' => ['placeholder' => 'Search for a city ...'],
			'pluginOptions' => [
				'allowClear' => true,
				'minimumInputLength' => 3,
				'ajax' => [
					'url' => $url,
					'dataType' => 'json',
					'data' => new JsExpression('function(term,page) { return {search:term}; }'),
					'results' => new JsExpression('function(data,page) { return {results:data.results}; }'),
				],
				'initSelection' => new JsExpression($initScript)
			],
		])
	},
	
],*/
	'machine_type'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Machine Type...', 'maxlength'=>100]], 
	'machine_arrival_date_estimation'=>['type'=> Form::INPUT_WIDGET, 'widgetClass'=>DateControl::classname(),'options'=>['type'=>DateControl::FORMAT_DATE, 'saveTimezone'=>Yii::$app->modules['datecontrol']['displayTimezone']]], 
	'delivery_date_request'=>['type'=> Form::INPUT_WIDGET, 'widgetClass'=>DateControl::classname(),'options'=>['type'=>DateControl::FORMAT_DATE, 'saveTimezone'=>Yii::$app->modules['datecontrol']['displayTimezone']]], 
	'installation_date_request'=>['type'=> Form::INPUT_WIDGET, 'widgetClass'=>DateControl::classname(),'options'=>['type'=>DateControl::FORMAT_DATE, 'saveTimezone'=>Yii::$app->modules['datecontrol']['displayTimezone']]], 
	//'duration'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Duration...']], 
	'warranty_term_from_supplier'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Warranty Term From Supplier...', 'maxlength'=>50]], 
	'warranty_term_to_customer'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Warranty Term To Customer...', 'maxlength'=>50]],
	'duration'=>['type'=>Form::INPUT_WIDGET, 'widgetClass'=>TouchSpin::classname(), 'name'=>'duration', 'options'=>['pluginOptions'=>['postfix'=>'days']]],
		'machine_delivery_direction_id'=>['type'=> Form::INPUT_DROPDOWN_LIST, 'options'=>['prompt'=>'--Select Machine Delivery Direction--'], 'items'=>$model->machineDirectionList], 
	'main_power_supply'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Main Power Supply...', 'maxlength'=>50]], 
	'customer_product_details'=>['type'=> Form::INPUT_WIDGET, 'widgetClass'=>TinyMCE::classname(), 'options'=>['placeholder'=>'Enter Customer Product Details...','rows'=> 6, 'height'=>50, 'toolbar'=>['bold italic','alignleft aligncenter alignright alignjustify','bullist numlist outdent indent',], 'menubar'=>false]],
		'material_for_machine_testing_id'=>['type'=> Form::INPUT_DROPDOWN_LIST, 'options'=>['prompt'=>'--Select Material For Machine Testing--'], 'items'=>$model->materialMachineList],  
	'material_specification_details'=>['type'=> Form::INPUT_WIDGET, 'widgetClass'=>TinyMCE::classname(), 'options'=>['placeholder'=>'Enter Material Specification Details...','rows'=> 6, 'height'=>50, 'toolbar'=>['bold italic','alignleft aligncenter alignright alignjustify','bullist numlist outdent indent',], 'menubar'=>false]], 
	'machine_accessories'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Machine Accessories...', 'maxlength'=>50]], 
		
	'special_requirement'=>['type'=> Form::INPUT_WIDGET, 'widgetClass'=>TinyMCE::classname(), 'options'=>['placeholder'=>'Enter Special Requirement...','rows'=> 6, 'height'=>50, 'toolbar'=>['bold italic','alignleft aligncenter alignright alignjustify','bullist numlist outdent indent',], 'menubar'=>false]], 
	'FOC_item'=>['type'=> Form::INPUT_WIDGET, 'widgetClass'=>TinyMCE::classname(), 'options'=>['placeholder'=>'Enter Foc Item...','rows'=> 6, 'height'=>50, 'toolbar'=>['bold italic','alignleft aligncenter alignright alignjustify','bullist numlist outdent indent',], 'menubar'=>false]], 
		 
	'free_service'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Free Service...']], 
	'total_free_service_per_year'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Total Free Service Per Year...']], 
	'period_of_rental'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Period Of Rental...', 'maxlength'=>50]], 
	'period_of_demo'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Period Of Demo...', 'maxlength'=>50]], 
	'problem_report_by_customer'=>['type'=> Form::INPUT_WIDGET, 'widgetClass'=>TinyMCE::classname(), 'options'=>['placeholder'=>'Enter Problem Report By Customer...','rows'=> 6, 'height'=>50, 'toolbar'=>['bold italic','alignleft aligncenter alignright alignjustify','bullist numlist outdent indent',], 'menubar'=>false]], 
	//'purpose'=>['type'=> Form::INPUT_TEXTAREA, 'options'=>['placeholder'=>'Enter Purpose...', 'rows'=>6]], 

	'purpose'=>['type'=> Form::INPUT_WIDGET, 'widgetClass'=>TinyMCE::classname(), 'options'=>['placeholder'=>'Enter Purpose...', 'rows'=>6, 'height'=>50, 'toolbar'=>['bold italic','alignleft aligncenter alignright alignjustify','bullist numlist outdent indent',], 'menubar'=>false]], 

	//'additional_comments'=>['type'=> Form::INPUT_TEXTAREA, 'options'=>['placeholder'=>'Enter Additional Comments...','rows'=> 6]], 
	'additional_comments'=>['type'=> Form::INPUT_WIDGET, 'widgetClass'=>TinyMCE::classname(), 'options'=>['placeholder'=>'Enter Additional Comments...','rows'=> 6, 'height'=>50, 'toolbar'=>['bold italic','alignleft aligncenter alignright alignjustify','bullist numlist outdent indent',], 'menubar'=>false]], 

	'request_status_id'=>['type'=> Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter Request Status ID...']], 
    ]


    ]);
    echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']);
    ActiveForm::end(); ?>

</div>
