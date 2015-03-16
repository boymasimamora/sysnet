<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Button;
use yii\bootstrap\Modal;
use kartik\detail\DetailView;
/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\SalesRequestSearch $searchModel
 */

$this->title = Yii::t('app', 'Pending Requests');
$this->params['breadcrumbs'][] = $this->title;

$connection = Yii::$app->db;
$user_id = Yii::$app->user->id;
$tech_admin = $connection->createCommand('SELECT case WHEN count(DISTINCT item_name) = 1 THEN "1" ELSE "0" end as bool FROM auth_assignment WHERE user_id = '.$user_id.' AND item_name LIKE("%echnical Admin")')->queryAll();
$tech_admin = $tech_admin[0]['bool'];
//echo $sales[0]['bool'];
?>

<script type="text/javascript">
    function changestatus(obj, id)
    {
        $.ajax({    
                type:"GET",
                url:"<?php echo Yii::$app->urlManager->createUrl('/sales-request/updatestatus'); ?>",
                data:"id="+id,
                // contentType: "application/json; charset=utf-8",
                dataType:"json",
                success:function(data){
                    var hasil = data.result[0].stat;
                    //alert('test');
                    //alert(hasil);
                    if(hasil == 1)
                    {
                        $(obj).removeClass("btn btn-warning btn-sm");
                        $(obj).addClass("btn btn-success btn-sm");
                        $(obj).html('Done');
                    }
                    else
                    {
                        $(obj).removeClass("btn btn-success btn-sm");
                        $(obj).addClass("btn btn-warning btn-sm");
                        $(obj).html('Pending');
                    }
                    $.pjax.reload({container:'#grid_request'});
                    //hoteleAlert('Data has been stored!');
                    /*setTimeout( function() {
                        jQuery('#loading_mask').hide();
                        window.location.href = "<?php echo Yii::$app->urlManager->createUrl('/ar/arMaster/index'); ?>";
                    }, 100 );*/
                }
            });

        
    }

    function tesdoang()
    {
        alert('tesdoang');
    }

    function showmodal(
            id, 
            request_type,
            submit_date,
            requestor,
            customer,
            customer_contact_person,
            customer_contact_number,
            machine_arrival_date_estimation,
            delivery_date_request,
            installation_date_request,
            duration, 
            machineDeliveryDirection,
            main_power_supply,
            customer_product_details,
            materialForMachineTesting,
            material_specification_details,
            machine_accessories,
            special_requirement,
            FOC_item,
            warranty_term_from_supplier,
            warranty_term_to_customer, 
            free_service,
            total_free_service_per_year,
            period_of_rental,
            period_of_demo,
            problem_report_by_customer,
            purpose,
            additional_comments,
            follow_up_date,
            followedUpBy, 
            technician,
            scheduled_date,
            notes,
            status,

            url_followup,
            url_reschedule,
            request_status_id
        )
    {
        var techadmin = $('#is_techadmin').val();
         

        var tab= "<table class='detail-view table table-hover table-bordered table-striped'>";
        tab+= "<tbody>";
        // tab+= "<tr><th style='width: 40%; text-align: right; vertical-align: middle;'>Request Type</th><td><div class='kv-attribute'>"+delivery_date_request+"</div></td>";
        if(request_type != "null") { tab+= "<tr><th style='width: 40%; text-align: right; vertical-align: middle;'>Request Type</th><td><div class='kv-attribute'>"+request_type+"</div></td>"; }
        if(submit_date != "null") { tab+= "<tr><th style='width: 40%; text-align: right; vertical-align: middle;'>Submit Date</th><td><div class='kv-attribute'>"+submit_date+"</div></td>"; }
        if(requestor != "null") { tab+= "<tr><th style='width: 40%; text-align: right; vertical-align: middle;'>Requestor</th><td><div class='kv-attribute'>"+requestor+"</div></td>"; }
        if(customer != "null") { tab+= "<tr><th style='width: 40%; text-align: right; vertical-align: middle;'>Customer</th><td><div class='kv-attribute'>"+customer+"</div></td>"; }
        if(customer_contact_person != "null") { tab+= "<tr><th style='width: 40%; text-align: right; vertical-align: middle;'>Contact Person</th><td><div class='kv-attribute'>"+customer_contact_person+"</div></td>"; }
        if(customer_contact_number != "null") { tab+= "<tr><th style='width: 40%; text-align: right; vertical-align: middle;'>Contact Number</th><td><div class='kv-attribute'>"+customer_contact_number+"</div></td>"; }
        if(machine_arrival_date_estimation != "null") { tab+= "<tr><th style='width: 40%; text-align: right; vertical-align: middle;'>Machine Arrival Date Estimation</th><td><div class='kv-attribute'>"+machine_arrival_date_estimation+"</div></td>"; }
        if(delivery_date_request != "null") { tab+= "<tr><th style='width: 40%; text-align: right; vertical-align: middle;'>Delivery Date Request</th><td><div class='kv-attribute'>"+delivery_date_request+"</div></td>"; }
        if(installation_date_request != "null") { tab+= "<tr><th style='width: 40%; text-align: right; vertical-align: middle;'>Installation Date Request</th><td><div class='kv-attribute'>"+installation_date_request+"</div></td>"; }
        if(duration != "null") { tab+= "<tr><th style='width: 40%; text-align: right; vertical-align: middle;'>Duration</th><td><div class='kv-attribute'>"+duration+"</div></td>"; }
        if(machineDeliveryDirection != "null") { tab+= "<tr><th style='width: 40%; text-align: right; vertical-align: middle;'>Machine Delivery Direction</th><td><div class='kv-attribute'>"+machineDeliveryDirection+"</div></td>"; }
        if(main_power_supply != "null") { tab+= "<tr><th style='width: 40%; text-align: right; vertical-align: middle;'>Main Power Supply</th><td><div class='kv-attribute'>"+main_power_supply+"</div></td>"; }
        if(customer_product_details != "null") { tab+= "<tr><th style='width: 40%; text-align: right; vertical-align: middle;'>Customer Product Details</th><td><div class='kv-attribute'>"+customer_product_details+"</div></td>"; }
        if(materialForMachineTesting != "null") { tab+= "<tr><th style='width: 40%; text-align: right; vertical-align: middle;'>Material for Machine Testing</th><td><div class='kv-attribute'>"+materialForMachineTesting+"</div></td>"; }
        if(material_specification_details != "null") { tab+= "<tr><th style='width: 40%; text-align: right; vertical-align: middle;'>Material Specification Details</th><td><div class='kv-attribute'>"+material_specification_details+"</div></td>"; }
        if(machine_accessories != "null") { tab+= "<tr><th style='width: 40%; text-align: right; vertical-align: middle;'>Machine Accessories</th><td><div class='kv-attribute'>"+machine_accessories+"</div></td>"; }
        if(special_requirement != "null") { tab+= "<tr><th style='width: 40%; text-align: right; vertical-align: middle;'>Special Requirement</th><td><div class='kv-attribute'>"+special_requirement+"</div></td>"; }
        if(FOC_item != "null") { tab+= "<tr><th style='width: 40%; text-align: right; vertical-align: middle;'>FOC Item</th><td><div class='kv-attribute'>"+FOC_item+"</div></td>"; }
        if(warranty_term_from_supplier != "null") { tab+= "<tr><th style='width: 40%; text-align: right; vertical-align: middle;'>Warranty Term From Supplier</th><td><div class='kv-attribute'>"+warranty_term_from_supplier+"</div></td>"; }
        if(warranty_term_to_customer != "null") { tab+= "<tr><th style='width: 40%; text-align: right; vertical-align: middle;'>Warranty Term to Customer</th><td><div class='kv-attribute'>"+warranty_term_to_customer+"</div></td>"; }
        if(free_service != "null") { tab+= "<tr><th style='width: 40%; text-align: right; vertical-align: middle;'>Free Service</th><td><div class='kv-attribute'>"+free_service+"</div></td>"; }
        if(total_free_service_per_year != "null") { tab+= "<tr><th style='width: 40%; text-align: right; vertical-align: middle;'>Total Free Service Per Year</th><td><div class='kv-attribute'>"+total_free_service_per_year+"</div></td>"; }
        if(period_of_rental != "null") { tab+= "<tr><th style='width: 40%; text-align: right; vertical-align: middle;'>Period of Rental</th><td><div class='kv-attribute'>"+period_of_rental+"</div></td>"; }
        if(period_of_demo != "null") { tab+= "<tr><th style='width: 40%; text-align: right; vertical-align: middle;'>Period of Demo</th><td><div class='kv-attribute'>"+period_of_demo+"</div></td>"; }
        if(problem_report_by_customer != "null") { tab+= "<tr><th style='width: 40%; text-align: right; vertical-align: middle;'>Problem Report by Customer</th><td><div class='kv-attribute'>"+problem_report_by_customer+"</div></td>"; }
        if(purpose != "null") { tab+= "<tr><th style='width: 40%; text-align: right; vertical-align: middle;'>Purpose</th><td><div class='kv-attribute'>"+purpose+"</div></td>"; }
        if(additional_comments != "null") { tab+= "<tr><th style='width: 40%; text-align: right; vertical-align: middle;'>Additional Comments</th><td><div class='kv-attribute'>"+additional_comments+"</div></td>"; }
        
        if(follow_up_date != "null") { tab+= "<tr style='background: #bce8f1;'><th style='width: 40%; text-align: right; vertical-align: middle;'>Follow Up Date</th><td><div class='kv-attribute'>"+follow_up_date+"</div></td>"; }
        if(followedUpBy != "null") { tab+= "<tr style='background: #bce8f1;'><th style='width: 40%; text-align: right; vertical-align: middle;'>Followed Up By</th><td><div class='kv-attribute'>"+followedUpBy+"</div></td>"; }
        if(technician != "null") { tab+= "<tr style='background: #bce8f1;'><th style='width: 40%; text-align: right; vertical-align: middle;'>Technician</th><td><div class='kv-attribute'>"+technician+"</div></td>"; }
        if(scheduled_date != "null") { tab+= "<tr style='background: #bce8f1;'><th style='width: 40%; text-align: right; vertical-align: middle;'>Scheduled Date</th><td><div class='kv-attribute'>"+scheduled_date+"</div></td>"; }
        if(notes != "null") { tab+= "<tr style='background: #bce8f1;'><th style='width: 40%; text-align: right; vertical-align: middle;'>Notes</th><td><div class='kv-attribute'>"+notes+"</div></td>"; }
        //if(status != "null") { tab+= "<tr style='background: #bce8f1;'><th style='width: 40%; text-align: right; vertical-align: middle;'>Status</th><td><div class='kv-attribute'>"+status+"</div></td>"; }
        
        tab+= "</tbody>";
        tab+="</table>";

        var btn = "<button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>";
        var btn_status = '';

        if(follow_up_date == "null") { 
            if(techadmin == 1) { 
                btn+= "<a id='btn_followup' type='button' class='btn btn-primary' href="+url_followup+">Follow Up</a>"; 
            }
            btn_status+= "<p><font size=4>Has Not Been Followed Up</font></p>";
        }
        else { 
            if(status == 0) { 
                if(techadmin == 1) { btn_status+= "<a type='button' id='btn_status"+id+"' onclick='changestatus(this,"+request_status_id+")' class='btn btn-warning btn-sm'>Pending</a>";  }
                else { btn_status+= "<a type='button' id='btn_status"+id+"' onclick='changestatus(this,"+request_status_id+")' class='btn btn-warning btn-sm' disabled='true'>Pending</a>";  }
            }
            else { 

                if(techadmin == 1) { btn_status+= "<a type='button' id='btn_status"+id+"' onclick='changestatus(this,"+request_status_id+")' class='btn btn-success btn-sm'>Done</a>"; }
                else { btn_status+= "<a type='button' id='btn_status"+id+"' onclick='changestatus(this,"+request_status_id+")' class='btn btn-success btn-sm' disabled='true'>Done</a>";  }
            }
            if(techadmin == 1) { btn+= "<a id='btn_followup' type='button' class='btn btn-default' href='"+url_reschedule+"'>Reschedule</a>"; }
            
        }

        document.getElementById("btn_modal").innerHTML = btn;
        document.getElementById("btn_status_req").innerHTML = btn_status;
        document.getElementById("table_modal").innerHTML = tab;

        /*document.getElementById("row_request_type").style.display = 'true'; 
        document.getElementById("row_submit_date").style.display = 'true'; 
        document.getElementById("row_requestor").style.display = 'true'; 
        document.getElementById("row_customer").style.display = 'true'; 
        document.getElementById("row_customer_contact_person").style.display = 'true'; 
        document.getElementById("row_customer_contact_number").style.display = 'true'; 
        document.getElementById("row_machine_arrival_date_estimation").style.display = 'true'; 
        document.getElementById("row_delivery_date_request").style.display = 'true'; 
        document.getElementById("row_installation_date_request").style.display = 'true'; 
        document.getElementById("row_duration").style.display = 'true'; 
        document.getElementById("row_machineDeliveryDirection").style.display = 'true'; 
        document.getElementById("row_main_power_supply").style.display = 'true'; 
        document.getElementById("row_customer_product_details").style.display = 'true'; 
        document.getElementById("row_materialForMachineTesting").style.display = 'true'; 
        document.getElementById("row_material_specification_details").style.display = 'true'; 
        document.getElementById("row_machine_accessories").style.display = 'true'; 
        document.getElementById("row_special_requirement").style.display = 'true'; 
        document.getElementById("row_FOC_item").style.display = 'true'; 
        document.getElementById("row_warranty_term_from_supplier").style.display = 'true'; 
        document.getElementById("row_warranty_term_to_customer").style.display = 'true'; 
        document.getElementById("row_free_service").style.display = 'true'; 
        document.getElementById("row_total_free_service_per_year").style.display = 'true'; 
        document.getElementById("row_period_of_rental").style.display = 'true'; 
        document.getElementById("row_period_of_demo").style.display = 'true'; 
        document.getElementById("row_problem_report_by_customer").style.display = 'true'; 
        document.getElementById("row_purpose").style.display = 'true'; 
        document.getElementById("row_additional_comments").style.display = 'true'; 
        document.getElementById("row_follow_up_date").style.display = 'true'; 
        document.getElementById("row_followedUpBy").style.display = 'true'; 
        document.getElementById("row_technician").style.display = 'true'; 
        document.getElementById("row_scheduled_date").style.display = 'true'; 
        document.getElementById("row_notes").style.display = 'true'; 
        document.getElementById("row_status").style.display = 'true'; */

        /*if(request_type == 'null') { document.getElementById("row_request_type").style.display = 'none'; }
            else { $('#exampleModal').find('#txt_request_type').text(request_type); }
        if(submit_date == 'null') { document.getElementById("row_submit_date").style.display = 'none'; }
            else { $('#exampleModal').find('#txt_submit_date').text(submit_date); }
        if(requestor == 'null') { document.getElementById("row_requestor").style.display = 'none'; }
            else { $('#exampleModal').find('#txt_requestor').text(requestor); }
        if(customer == 'null') { document.getElementById("row_customer").style.display = 'none'; }
            else { $('#exampleModal').find('#txt_customer').text(customer); }
        if(customer_contact_person == 'null') { document.getElementById("row_customer_contact_person").style.display = 'none'; }
            else { $('#exampleModal').find('#txt_customer_contact_person').text(customer_contact_person); }
        if(customer_contact_number == 'null') { document.getElementById("row_customer_contact_number").style.display = 'none'; }
            else { $('#exampleModal').find('#txt_customer_contact_number').text(customer_contact_number); }
        if(machine_arrival_date_estimation == 'null') { document.getElementById("row_machine_arrival_date_estimation").style.display = 'none'; }
            else { $('#exampleModal').find('#txt_machine_arrival_date_estimation').text(machine_arrival_date_estimation); }
        if(delivery_date_request == 'null') { document.getElementById("row_delivery_date_request").style.display = 'none'; }
            else { $('#exampleModal').find('#txt_delivery_date_request').text(delivery_date_request); }
        if(installation_date_request == 'null') { document.getElementById("row_installation_date_request").style.display = 'none'; }
            else { $('#exampleModal').find('#txt_installation_date_request').text(installation_date_request); }
        if(duration == 'null') { document.getElementById("row_duration").style.display = 'none'; }
            else { $('#exampleModal').find('#txt_duration').text(duration); }
        if(machineDeliveryDirection == 'null') { document.getElementById("row_machineDeliveryDirection").style.display = 'none'; }
            else { $('#exampleModal').find('#txt_machineDeliveryDirection').text(machineDeliveryDirection); }
        if(main_power_supply == 'null') { document.getElementById("row_main_power_supply").style.display = 'none'; }
            else { $('#exampleModal').find('#txt_main_power_supply').text(main_power_supply); }
        if(customer_product_details == 'null') { document.getElementById("row_customer_product_details").style.display = 'none'; }
            else { $('#exampleModal').find('#txt_customer_product_details').text(customer_product_details); }
        if(materialForMachineTesting == 'null') { document.getElementById("row_materialForMachineTesting").style.display = 'none'; }
            else { $('#exampleModal').find('#txt_materialForMachineTesting').text(materialForMachineTesting); }
        if(material_specification_details == 'null') { document.getElementById("row_material_specification_details").style.display = 'none'; }
            else { $('#exampleModal').find('#txt_material_specification_details').text(material_specification_details); }
        if(machine_accessories == 'null') { document.getElementById("row_machine_accessories").style.display = 'none'; }
            else { $('#exampleModal').find('#txt_machine_accessories').text(machine_accessories); }
        if(special_requirement == 'null') { document.getElementById("row_special_requirement").style.display = 'none'; }
            else { $('#exampleModal').find('#txt_special_requirement').text(special_requirement); }
        if(FOC_item == 'null') { document.getElementById("row_FOC_item").style.display = 'none'; }
            else { $('#exampleModal').find('#txt_FOC_item').text(FOC_item); }
        if(warranty_term_from_supplier == 'null') { document.getElementById("row_warranty_term_from_supplier").style.display = 'none'; }
            else { $('#exampleModal').find('#txt_warranty_term_from_supplier').text(warranty_term_from_supplier); }
        if(warranty_term_to_customer == 'null') { document.getElementById("row_warranty_term_to_customer").style.display = 'none'; }
            else { $('#exampleModal').find('#txt_warranty_term_to_customer').text(warranty_term_to_customer); }
        if(free_service == 'null') { document.getElementById("row_free_service").style.display = 'none'; }
            else { $('#exampleModal').find('#txt_free_service').text(free_service); }
        if(total_free_service_per_year == 'null') { document.getElementById("row_total_free_service_per_year").style.display = 'none'; }
            else { $('#exampleModal').find('#txt_total_free_service_per_year').text(total_free_service_per_year); }
        if(period_of_rental == 'null') { document.getElementById("row_period_of_rental").style.display = 'none'; }
            else { $('#exampleModal').find('#txt_period_of_rental').text(period_of_rental); }
        if(period_of_demo == 'null') { document.getElementById("row_period_of_demo").style.display = 'none'; }
            else { $('#exampleModal').find('#txt_period_of_demo').text(period_of_demo); }
        if(problem_report_by_customer == 'null') { document.getElementById("row_problem_report_by_customer").style.display = 'none'; }
            else { $('#exampleModal').find('#txt_problem_report_by_customer').text(problem_report_by_customer); }
        if(purpose == 'null') { document.getElementById("row_purpose").style.display = 'none'; }
            else { $('#exampleModal').find('#txt_purpose').text(purpose); }
        if(additional_comments == 'null') { document.getElementById("row_additional_comments").style.display = 'none'; }
            else { $('#exampleModal').find('#txt_additional_comments').text(additional_comments); }
        if(follow_up_date == 'null') { document.getElementById("row_follow_up_date").style.display = 'none'; }
            else { $('#exampleModal').find('#txt_follow_up_date').text(follow_up_date); }
        if(followedUpBy == 'null') { document.getElementById("row_followedUpBy").style.display = 'none'; }
            else { $('#exampleModal').find('#txt_followedUpBy').text(followedUpBy); }
        if(technician == 'null') { document.getElementById("row_technician").style.display = 'none'; }
            else { $('#exampleModal').find('#txt_technician').text(technician); }
        if(scheduled_date == 'null') { document.getElementById("row_scheduled_date").style.display = 'none'; }
            else { $('#exampleModal').find('#txt_scheduled_date').text(scheduled_date); }
        if(notes == 'null') { document.getElementById("row_notes").style.display = 'none'; }
            else { $('#exampleModal').find('#txt_notes').text(notes); }
        if(status == 'null') { document.getElementById("row_status").style.display = 'none'; }
            else { $('#exampleModal').find('#txt_status').text(status); }*/

        //document.getElementById("row_status").style.display = 'none';
        //$('#exampleModal').find('#status').text(status);
        $('#exampleModal').modal('show');
            //var modal = $(this);
            //modal.find('.modal-title').text('New message to ' + id);
            //$('#exampleModal #recipient-name').val(id);
            //$(event.currentTarget).find('input[id="recipient-name"]').val(id);
        
    }
</script>

<div class="sales-request-index">
    <div class="page-header">
            <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php /* echo Html::a(Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Sales Request',
]), ['create'], ['class' => 'btn btn-success'])*/  ?>
    </p>
    <input id="is_techadmin" value="<?php echo $tech_admin; ?>" hidden="true"></input>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div style="display: inline-flex"><h4 class="modal-title" id="exampleModalLabel">Request Status : &nbsp;</h4> <div id="btn_status_req"></div></div>
      </div>
      <div class="modal-body">
        <form id="w5" method="post" action="/web/index.php/sales-request/index">
            <input type="hidden" value="X2pUOS5VUDMMIAV3HRc5VzhTIkpFER96OwcODVgNI2kdIGVpQWMKdA==" name="_csrf">
            <div id="w4">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <div class="pull-right">
                            <span class="kv-buttons-1"> </span>
                            <span class="kv-buttons-2" style="display:none"> </span>
                        </div>
                        Request Detail
                    </div>
                    <div class="table-responsive" id="table_modal">
                        
                        
                        </table>
                    </div>
                </div>
            </div>
        </form>
        <!-- <form>
          <div class="form-group">
            <label for="recipient-name" class="control-label">Recipient:</label>
            <input type="text" class="form-control" id="recipient-name">
          </div>
        </form> -->
      </div>
      <div class="modal-footer" id="btn_modal">
        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
        <!-- <a id="btn_followup" type="button" class="btn btn-primary" href="#">Follow Up</a> -->
      </div>
    </div>
  </div>
</div>

    <?php 


    Pjax::begin(); echo GridView::widget([
        'id'=>'grid_request',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'request_type.type',
            //'user.email',
            //'profile.name',
            [
                'attribute'=>'user.email',
                'format'=>'raw',
                'value'=>function($data)
                {
                    if($data->profile->name == null) { return $data->user->email; }
                    else return $data->profile->name;
                }
            ],
            //'request_type_id',
            //['attribute'=>'submit_date','format'=>['datetime','php:d-m-Y H:i:s']],
            //'submit_date',
            [
                'attribute'=>'submit_date',
                'format'=>'raw',
                'value'=>function($data)
                {
                    return substr($data->submit_date, 0, -8);
                },
            ],
            //['attribute'=>'submit_date','format'=>['datetime',(isset(Yii::$app->modules['datecontrol']['displaySettings']['datetime'])) ? Yii::$app->modules['datecontrol']['displaySettings']['datetime'] : 'd-m-Y H:i:s']],
            //'submit_by_id',
            //'customer_id',
            'customer.name',
            'request_status.scheduled_date',
            //$data->request_status->scheduled_date == null ? ['visible'=>false] : ['attribute'=>'request_status.scheduled_date', 'value'=>date('d/M/Y', strtotime($data->request_status->scheduled_date))],
            /*[
                'attribute'=>'request_status.scheduled_date',
                'format'=>'raw',
                'value'=>function($data)
                {
                    //return $data->request_status->scheduled_date;
                    if($data->request_status->scheduled_date == null)
                    {
                        return 'test';
                    }
                    else
                    {
                        return $data->request_status->scheduled_date;
                    }
                    //$data->request_status->scheduled_date == null ? ['visible'=>false] : ['attribute'=>'request_status.scheduled_date', 'value'=>date('d/M/Y', strtotime($data->request_status->scheduled_date))];
                }
            ],*/
//            ['attribute'=>'machine_arrival_date_estimation','format'=>['date',(isset(Yii::$app->modules['datecontrol']['displaySettings']['date'])) ? Yii::$app->modules['datecontrol']['displaySettings']['date'] : 'd-m-Y']], 
//            ['attribute'=>'delivery_date_request','format'=>['date',(isset(Yii::$app->modules['datecontrol']['displaySettings']['date'])) ? Yii::$app->modules['datecontrol']['displaySettings']['date'] : 'd-m-Y']], 
//            ['attribute'=>'installation_date_request','format'=>['date',(isset(Yii::$app->modules['datecontrol']['displaySettings']['date'])) ? Yii::$app->modules['datecontrol']['displaySettings']['date'] : 'd-m-Y']], 
//            'machine_delivery_direction_id', 
//            'main_power_supply', 
//            'customer_product_details:ntext', 
//            'material_for_machine_testing_id', 
//            'material_specification_details:ntext', 
//            'machine_accessories', 
//            'special_requirement:ntext', 
//            'FOC_item:ntext', 
//            'warranty_term_from_supplier', 
//            'warranty_term_to_customer', 
//            'free_service', 
//            'total_free_service_per_year', 
//            'period_of_rental', 
//            'period_of_demo', 
//            'problem_report_by_customer:ntext', 
//            'purpose', 
//            'additional_comments:ntext', 
//            'request_status_id', 

            /*[
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                'update' => function ($url, $model) {
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', Yii::$app->urlManager->createUrl(['sales-request/view','id' => $model->id,'edit'=>'t']), [
                                                    'title' => Yii::t('yii', 'Edit'),
                                                  ]);}

                ],
            ],*/
            /*[
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'test' => function ($url, $model, $key) {
                        return "<a class='btn btn-success'> test bro </a>";
                    }
                ],
            ],*/
            [
                'visible'=>false,
                'format' => 'raw',
                'value'=>function ($data) {
                    //return '<button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modalview" href="'.Yii::$app->urlManager->createUrl(['site/index']).'">View</button>';
                    return '
                                <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modalview'.$data->id.'">View</button>
                                <div id="modalview'.$data->id.'" class="fade modal">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title">Request Details</h4>
                                            </div>
                                            <div class="modal-body">
                                                '.
                                                    DetailView::widget([
                                                        'model' => $data,
                                                        'condensed'=>false,
                                                        'hover'=>true,
                                                        'mode'=>Yii::$app->request->get('edit')=='t' ? DetailView::MODE_EDIT : DetailView::MODE_VIEW,
                                                        'panel'=>[
                                                        'heading'=>$this->title,
                                                        'type'=>DetailView::TYPE_INFO,
                                                    ],
                                                    'attributes' => [
                                                        //'id',
                                                        [
                                                            'attribute'=>'request_type_id',
                                                            'value'=>$data->request_type->type,
                                                        ],
                                                        'submit_date',
                                                        [
                                                            'attribute'=>'submit_by_id',
                                                            'value'=>$data->profile->name,
                                                        ],
                                                        [
                                                            'attribute'=>'customer_id',
                                                            'value'=>$data->customer->name,
                                                        ],
                                                        [
                                                            'label'=>'Customer Address',
                                                            'value'=>$data->customer->address,
                                                        ],
                                                        [
                                                            'label'=>'Contact Person',
                                                            'value'=>$data->customer_contact_person,
                                                        ],
                                                        [
                                                            'label'=>'Contact Number',
                                                            'value'=>$data->customer_contact_number,
                                                        ],
                                                        //'machine_arrival_date_estimation',
                                                        $data->machine_arrival_date_estimation == null ? ['visible'=>false] : ['attribute'=>'machine_arrival_date_estimation', 'value'=>date('d/M/Y', strtotime($data->machine_arrival_date_estimation))],
                                                        //'delivery_date_request',
                                                        $data->delivery_date_request == null ? ['visible'=>false] : ['attribute'=>'delivery_date_request', 'value'=>date('d/M/Y', strtotime($data->delivery_date_request))],
                                                        //'installation_date_request',
                                                        $data->installation_date_request == null ? ['visible'=>false] : ['attribute'=>'installation_date_request', 'value'=>date('d/M/Y', strtotime($data->installation_date_request))],
                                                        //'machine_delivery_direction_id',
                                                        $data->machine_delivery_direction_id == null ? ['visible'=>false] : ['attribute'=>'machine_delivery_direction_id', 'value'=>$data->machineDeliveryDirection->option],
                                                        //'main_power_supply',
                                                        $data->main_power_supply == null ? ['visible'=>false] : ['attribute'=>'main_power_supply', 'value'=>$data->main_power_supply],
                                                        //'customer_product_details:ntext',
                                                        $data->customer_product_details == null ? ['visible'=>false] : ['attribute'=>'customer_product_details', 'value'=>$data->customer_product_details],
                                                        //'material_for_machine_testing_id',
                                                        $data->material_for_machine_testing_id == null ? ['visible'=>false] : ['attribute'=>'material_for_machine_testing_id', 'value'=>$data->materialForMachineTesting->option],
                                                        //'material_specification_details:ntext',
                                                        $data->material_specification_details == null ? ['visible'=>false] : ['attribute'=>'material_specification_details', 'value'=>$data->material_specification_details],
                                                        //'machine_accessories',
                                                        $data->machine_accessories == null ? ['visible'=>false] : ['attribute'=>'machine_accessories', 'value'=>$data->machine_accessories],
                                                        //'special_requirement:ntext',
                                                        $data->special_requirement == null ? ['visible'=>false] : ['attribute'=>'special_requirement', 'value'=>$data->special_requirement],
                                                        //'FOC_item:ntext',
                                                        $data->FOC_item == null ? ['visible'=>false] : ['attribute'=>'FOC_item', 'value'=>$data->FOC_item],
                                                        //'warranty_term_from_supplier',
                                                        $data->warranty_term_from_supplier == null ? ['visible'=>false] : ['attribute'=>'warranty_term_from_supplier', 'value'=>$data->warranty_term_from_supplier],
                                                        //'warranty_term_to_customer',
                                                        $data->warranty_term_to_customer == null ? ['visible'=>false] : ['attribute'=>'warranty_term_to_customer', 'value'=>$data->warranty_term_to_customer],
                                                        //'free_service',
                                                        $data->free_service == null ? ['visible'=>false] : ['attribute'=>'free_service', 'value'=>$data->free_service],
                                                        //'total_free_service_per_year',
                                                        $data->total_free_service_per_year == null ? ['visible'=>false] : ['attribute'=>'total_free_service_per_year', 'value'=>$data->total_free_service_per_year],
                                                        //'period_of_rental',
                                                        $data->period_of_rental == null ? ['visible'=>false] : ['attribute'=>'period_of_rental', 'value'=>$data->period_of_rental],
                                                        //'period_of_demo',
                                                        $data->period_of_demo == null ? ['visible'=>false] : ['attribute'=>'period_of_demo', 'value'=>$data->period_of_demo],
                                                        //'problem_report_by_customer:ntext',
                                                        $data->problem_report_by_customer == null ? ['visible'=>false] : ['attribute'=>'problem_report_by_customer', 'value'=>$data->problem_report_by_customer],
                                                        //'purpose',
                                                        $data->purpose == null ? ['visible'=>false] : ['attribute'=>'purpose', 'value'=>$data->purpose],
                                                        //'additional_comments:ntext',
                                                        $data->additional_comments == null ? ['visible'=>false] : ['attribute'=>'additional_comments', 'value'=>$data->additional_comments],
                                                        //'request_status_id',
                                                        $data->request_status_id == null ? ['visible'=>false] : ['attribute'=>'request_status_id', 'value'=>$data->request_status_id],
                                                    ],
                                                    /*'deleteOptions'=>[
                                                        //'url'=>['delete', 'id' => \app\models\SalesRequest->id],
                                                        'data'=>[
                                                            'confirm'=>Yii::t('app', 'Are you sure you want to delete this item?'),
                                                            'method'=>'post',
                                                        ],
                                                    ],*/
                                                    'enableEditMode'=>false,
                                                ]) 
                                                .'
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            ';
                },  
            ],
            /*[
                //'label'=>'tombol',
                'format' => 'raw',
                'value'=>function ($data) {
                    if($data->request_status_id == null)
                    {
                        return '<a type="button" class="btn btn-primary btn-sm" href='.Yii::$app->homeUrl."/request-status/create?req=".$data->id.'>Follow Up</a>';
                    }
                    else
                    {
                        if($data->request_status->status == 0)
                        {
                            return '<a type="button" id="btn_status'.$data->id.'" onclick="changestatus(this,'.$data->request_status->id.')" class="btn btn-warning btn-sm">Pending</a>';
                        }
                        else
                        {
                            return '<a type="button" id="btn_status'.$data->id.'" onclick="changestatus(this,'.$data->request_status->id.')" class="btn btn-success btn-sm">Done</a>';
                        }
                    }
                },  
            ],*/
            [
                'attribute'=>'done',
                'format'=>'raw',
                'class' => '\kartik\grid\BooleanColumn',
                //'attribute'=>'request_status.status',
                /*'value'=>function($data){
                    $status = null;
                    if($data->request_status_id != null && $data->request_status->status == 1) { $status = 1; }
                    return $status;
                },*/
                'showNullAsFalse'=>true,
                'trueLabel' => 'Done',
                //'trueIcon'=> '',
                'falseLabel' => 'Pending'
            ],
            /*[
                'format' => 'raw',
                'value'=>function($data){
                     Modal::begin([
                        'header' => '<h2>'.\Yii::$app->view->renderFile('@app/views/site/calendar.php').'</h2>',
                        'toggleButton' => ['label' => 'click me'],
                    ]);

                    echo 'Say hello...';

                    Modal::end();
                }
                
            ],*/
           /* [
                Button::widget(['label'=>'tombol', 'options' => ['class' => 'btn-lg']])
            ],*/
            /* [
                'class' => '\yii\bootstrap\Button',
                'label' => 'tombol',
            ],*/
            //'<input class="buttonClass" id="buttonId" name="yt1" type="button" value="myButton">'
        ],
        'rowOptions' => function ($data) {
                $id  = $data->id == null ? 'null' : $data->id;  
                $request_type = $data->request_type_id == null ? 'null' : $data->request_type->type;
                $submit_date = $data->submit_date == null ? 'null' : $data->submit_date;
                $requestor = $data->profile->name == null ? $data->user->email : $data->profile->name;
                $customer = $data->customer_id == null ? 'null' : $data->customer->name;
                $customer_contact_person = $data->customer_contact_person == null ? 'null' : $data->customer_contact_person;
                $customer_contact_number = $data->customer_contact_number == null ? 'null' : $data->customer_contact_number;
                $machine_arrival_date_estimation = $data->machine_arrival_date_estimation == null ? 'null' : $data->machine_arrival_date_estimation;
                $delivery_date_request = $data->delivery_date_request == null ? 'null' : $data->delivery_date_request;
                $installation_date_request = $data->installation_date_request == null ? 'null' : $data->installation_date_request;
                $duration  = $data->duration == null ? 'null' : $data->duration;  
                $machineDeliveryDirection = $data->machine_delivery_direction_id == null ? 'null' : $data->machineDeliveryDirection->option;
                $main_power_supply = $data->main_power_supply == null ? 'null' : $data->main_power_supply;

                $customer_product_details = $data->customer_product_details == null ? 'null' : htmlspecialchars_decode($data->customer_product_details);
                //$customer_product_details = str_replace( "\n", '<br />', $customer_product_details ); 
                //$customer_product_details = preg_replace("/\s+|\n+|\r/", ' ', $customer_product_details);

                $materialForMachineTesting = $data->material_for_machine_testing_id == null ? 'null' : $data->materialForMachineTesting->option;
                
                $material_specification_details = $data->material_specification_details == null ? 'null' : htmlspecialchars_decode($data->material_specification_details);
                //$material_specification_details = str_replace(PHP_EOL, '', $material_specification_details);
                //$material_specification_details = str_replace( "\n", '<br />', $material_specification_details ); 
                //$material_specification_details = preg_replace("/\s+|\n+|\r/", ' ', $material_specification_details);

                $machine_accessories = $data->machine_accessories == null ? 'null' : $data->machine_accessories;

                $special_requirement = $data->special_requirement == null ? 'null' : htmlspecialchars_decode($data->special_requirement);
                //$special_requirement = str_replace(PHP_EOL, '', $special_requirement);
                //$special_requirement = str_replace( "\n", '<br />', $special_requirement ); 
                //$special_requirement = preg_replace("/\s+|\n+|\r/", ' ', $special_requirement);

                $FOC_item = $data->FOC_item == null ? 'null' : htmlspecialchars_decode($data->FOC_item);
                //$FOC_item = str_replace(PHP_EOL, '', $FOC_item);
                //$FOC_item = str_replace( "\n", '<br />', $FOC_item ); 
                //$FOC_item = preg_replace("/\s+|\n+|\r/", ' ', $FOC_item);

                $warranty_term_from_supplier = $data->warranty_term_from_supplier == null ? 'null' : $data->warranty_term_from_supplier;
                $warranty_term_to_customer  = $data->warranty_term_to_customer == null ? 'null' : $data->warranty_term_to_customer;  
                $free_service = $data->free_service == null ? 'null' : $data->free_service;
                $total_free_service_per_year = $data->total_free_service_per_year == null ? 'null' : $data->total_free_service_per_year;
                $period_of_rental = $data->period_of_rental == null ? 'null' : $data->period_of_rental;
                $period_of_demo = $data->period_of_demo == null ? 'null' : $data->period_of_demo;

                $problem_report_by_customer = $data->problem_report_by_customer == null ? 'null' : htmlspecialchars_decode($data->problem_report_by_customer);
                //$problem_report_by_customer = str_replace(PHP_EOL, '', $problem_report_by_customer);
                //$problem_report_by_customer = str_replace( "\n", '<br />', $problem_report_by_customer ); 
                //$problem_report_by_customer = preg_replace("/\s+|\n+|\r/", ' ', $problem_report_by_customer);

                $purpose = $data->purpose == null ? 'null' : htmlspecialchars_decode($data->purpose, ENT_NOQUOTES);
                //$purpose = str_replace(PHP_EOL, '', $purpose);
                //$purpose = str_replace( "\n", '<br />', $purpose ); 
                //$purpose = preg_replace("/\s+|\n+|\r/", ' ', $purpose);

                $additional_comments = $data->additional_comments == null ? 'null' : htmlspecialchars_decode($data->additional_comments);
                //$additional_comments = str_replace(PHP_EOL, '', $additional_comments);
                //$additional_comments = str_replace( "\n", '<br />', $additional_comments ); 
                //$additional_comments = preg_replace("/\s+|\n+|\r/", ' ', $additional_comments);

                $follow_up_date = $data->request_status_id == null ? 'null' : $data->request_status->follow_up_date;
                
                $followedUpBy = ''; 
                if($data->request_status_id == null)
                {
                    $followedUpBy = 'null';  
                }
                else {
                    if($data->request_status->followedUpBy->profile->name == null)
                    {
                        $followedUpBy = $data->request_status->followedUpBy->email;
                    }
                } 
                
                $technician = $data->request_status_id == null ? 'null' : $data->request_status->technician;
                $scheduled_date = $data->request_status_id == null ? 'null' : $data->request_status->scheduled_date;
                
                $notes = $data->request_status_id == null ? 'null' : htmlspecialchars_decode($data->request_status->notes);
                //$notes = str_replace(PHP_EOL, '', $notes);
                //$notes = str_replace( "\n", '<br />', $notes ); 
                //$notes = preg_replace("/\s+|\n+|\r/", ' ', $notes);

                $status = $data->request_status_id == null ? 'null' : $data->request_status->status;      

                $request_status_id = $data->request_status_id == null ? 'null' : $data->request_status_id;

                $url_followup = Yii::$app->homeUrl."/request-status/create?req=".$id;  
                $url_reschedule = Yii::$app->homeUrl."/request-status/update?id=".$request_status_id;       

                $row_color = '#31708f';
                $row_background = '#d9edf7';
                $row_border = '#bce8f1';
                if($data->request_status_id != null)
                {
                    if($status == 1){ 
                        $row_background = '#dff0d8'; 
                        $row_border = '#d6e9c6';
                        $row_color = '#3c763d';
                    }
                    else if($status == 0){ 
                        $row_background = '#fcf8e3'; 
                        $row_border = '#faebcc';
                        $row_color = '#8a6d3b';
                    }
                }


                return [
                    'id'=>$data->id,
                    'request_type'=>$data->submit_date,
                    'style'=>'background-color:'.$row_background.'; color:'.$row_color.'; border-color:'.$row_border,
                    'onclick' => "showmodal(
                        '".$id."',
                        '".$request_type."',
                        '".$submit_date."',
                        '".$requestor."',
                        '".$customer."',
                        '".$customer_contact_person."',
                        '".$customer_contact_number."',
                        '".$machine_arrival_date_estimation."',
                        '".$delivery_date_request."',
                        '".$installation_date_request."',

                        '".$duration."',
                        '".$machineDeliveryDirection."',
                        '".$main_power_supply."',
                        '".$customer_product_details."',
                        '".$materialForMachineTesting."',
                        '".$material_specification_details."',
                        '".$machine_accessories."',
                        '".$special_requirement."',
                        '".$FOC_item."',
                        '".$warranty_term_from_supplier."',

                        '".$warranty_term_to_customer."',
                        '".$free_service."',
                        '".$total_free_service_per_year."',
                        '".$period_of_rental."',
                        '".$period_of_demo."',
                        '".$problem_report_by_customer."',
                        '".$purpose."',
                        '".$additional_comments."',
                        '".$follow_up_date."',

                        '".$followedUpBy."',
                        '".$technician."',
                        '".$scheduled_date."',
                        '".$notes."',
                        '".$status."',

                        '".$url_followup."',
                        '".$url_reschedule."',
                        '".$request_status_id."'
                        );"
                ];
        },
        'responsive'=>true,
        'hover'=>true,
        'condensed'=>true,
        'floatHeader'=>true,




        'panel' => [
            'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-th-list"></i> '.Html::encode($this->title).' </h3>',
            'type'=>'info',
            'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Add', ['create'], ['class' => 'btn btn-success']),                                                                                                                                                          'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset List', ['index'], ['class' => 'btn btn-info']),
            'showFooter'=>false
        ],
    ]); Pjax::end(); ?>

</div>