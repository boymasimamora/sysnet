<?php
//namespace app\models;

use yii\helpers\Html;
use kartik\detail\DetailView;
use kartik\datecontrol\DateControl;

use yii\helpers\ArrayHelper;

/**
 * @var yii\web\View $this
 * @var app\models\SalesRequest $model
 */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sales Requests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sales-request-view">
    <div class="page-header">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>


    <?= DetailView::widget([
            'model' => $model,
            'condensed'=>false,
            'hover'=>true,
            'mode'=>Yii::$app->request->get('edit')=='t' ? DetailView::MODE_EDIT : DetailView::MODE_VIEW,
            'panel'=>[
            'heading'=>$this->title,
            'type'=>DetailView::TYPE_INFO,
        ],
        'attributes' => [
            [
                'attribute'=>'request_type_id',
                'value'=>$model->request_type->type,
            ],
            'submit_date',
            [
                'attribute'=>'submit_by_id',
                'value'=>$model->user->email,
            ],
            [
                'attribute'=>'customer_id',
                'value'=>$model->customer->name,
            ],
            [
                'attribute'=>'customer_contact_person',
                'value'=>$model->customer_contact_person,
            ],
            [
                'attribute'=>'customer_contact_number',
                'value'=>$model->customer_contact_number,
            ],
            //'machine_arrival_date_estimation',
            $model->machine_arrival_date_estimation == null ? ['visible'=>false] : ['attribute'=>'machine_arrival_date_estimation', 'value'=>date('d/M/Y', strtotime($model->machine_arrival_date_estimation))],
            //'delivery_date_request',
            $model->delivery_date_request == null ? ['visible'=>false] : ['attribute'=>'delivery_date_request', 'value'=>date('d/M/Y', strtotime($model->delivery_date_request))],
            //'installation_date_request',
            $model->installation_date_request == null ? ['visible'=>false] : ['attribute'=>'installation_date_request', 'value'=>date('d/M/Y', strtotime($model->installation_date_request))],
            //'duration',
            $model->duration == null ? ['visible'=>false] : ['attribute'=>'duration', 'value'=>$model->duration.' days'],
            //'machine_delivery_direction_id',
            $model->machine_delivery_direction_id == null ? ['visible'=>false] : ['attribute'=>'machine_delivery_direction_id', 'value'=>$model->machineDeliveryDirection->option],
            //'main_power_supply',
            $model->main_power_supply == null ? ['visible'=>false] : ['attribute'=>'main_power_supply', 'value'=>$model->main_power_supply],
            //'customer_product_details:ntext',
            $model->customer_product_details == null ? ['visible'=>false] : ['attribute'=>'customer_product_details', 'value'=>$model->customer_product_details],
            //'material_for_machine_testing_id',
            $model->material_for_machine_testing_id == null ? ['visible'=>false] : ['attribute'=>'material_for_machine_testing_id', 'value'=>$model->materialForMachineTesting->option],
            //'material_specification_details:ntext',
            $model->material_specification_details == null ? ['visible'=>false] : ['attribute'=>'material_specification_details', 'value'=>$model->material_specification_details],
            //'machine_accessories',
            $model->machine_accessories == null ? ['visible'=>false] : ['attribute'=>'machine_accessories', 'value'=>$model->machine_accessories],
            //'special_requirement:ntext',
            $model->special_requirement == null ? ['visible'=>false] : ['attribute'=>'special_requirement', 'value'=>$model->special_requirement],
            //'FOC_item:ntext',
            $model->FOC_item == null ? ['visible'=>false] : ['attribute'=>'FOC_item', 'value'=>$model->FOC_item],
            //'warranty_term_from_supplier',
            $model->warranty_term_from_supplier == null ? ['visible'=>false] : ['attribute'=>'warranty_term_from_supplier', 'value'=>$model->warranty_term_from_supplier],
            //'warranty_term_to_customer',
            $model->warranty_term_to_customer == null ? ['visible'=>false] : ['attribute'=>'warranty_term_to_customer', 'value'=>$model->warranty_term_to_customer],
            //'free_service',
            $model->free_service == null ? ['visible'=>false] : ['attribute'=>'free_service', 'value'=>$model->free_service],
            //'total_free_service_per_year',
            $model->total_free_service_per_year == null ? ['visible'=>false] : ['attribute'=>'total_free_service_per_year', 'value'=>$model->total_free_service_per_year],
            //'period_of_rental',
            $model->period_of_rental == null ? ['visible'=>false] : ['attribute'=>'period_of_rental', 'value'=>$model->period_of_rental],
            //'period_of_demo',
            $model->period_of_demo == null ? ['visible'=>false] : ['attribute'=>'period_of_demo', 'value'=>$model->period_of_demo],
            //'problem_report_by_customer:ntext',
            $model->problem_report_by_customer == null ? ['visible'=>false] : ['attribute'=>'problem_report_by_customer', 'value'=>$model->problem_report_by_customer],
            //'purpose',
            $model->purpose == null ? ['visible'=>false] : ['attribute'=>'purpose', 'value'=>$model->purpose],
            //'additional_comments:ntext',
            $model->additional_comments == null ? ['visible'=>false] : ['attribute'=>'additional_comments', 'value'=>$model->additional_comments],
            //'id',
            // 'request_type_id',
            // [
            //     'attribute'=>'request_type_id',
            //     'value'=>$model->request_type->type,
            // ],
            // 'submit_date',
            // [
            //     'attribute'=>'submit_date',
            //     'format'=>['datetime',(isset(Yii::$app->modules['datecontrol']['displaySettings']['datetime'])) ? Yii::$app->modules['datecontrol']['displaySettings']['datetime'] : 'd-m-Y H:i:s'],
            //     'type'=>DetailView::INPUT_WIDGET,
            //     'widgetOptions'=> [
            //         'class'=>DateControl::classname(),
            //         'type'=>DateControl::FORMAT_DATETIME
            //     ]
            // ],
            // //'submit_by_id',
            // [
            //     'attribute'=>'submit_by_id',
            //     'value'=>$model->user->email,
            // ],
            // //'customer_id',
            // [
            //     'attribute'=>'customer_id',
            //     'value'=>$model->customer->name,
            // ],
            // [
            //     'attribute'=>'machine_arrival_date_estimation',
            //     'format'=>['date',(isset(Yii::$app->modules['datecontrol']['displaySettings']['date'])) ? Yii::$app->modules['datecontrol']['displaySettings']['date'] : 'd-m-Y'],
            //     'type'=>DetailView::INPUT_WIDGET,
            //     'widgetOptions'=> [
            //         'class'=>DateControl::classname(),
            //         'type'=>DateControl::FORMAT_DATE
            //     ]
            // ],
            // [
            //     'attribute'=>'delivery_date_request',
            //     'format'=>['date',(isset(Yii::$app->modules['datecontrol']['displaySettings']['date'])) ? Yii::$app->modules['datecontrol']['displaySettings']['date'] : 'd-m-Y'],
            //     'type'=>DetailView::INPUT_WIDGET,
            //     'widgetOptions'=> [
            //         'class'=>DateControl::classname(),
            //         'type'=>DateControl::FORMAT_DATE
            //     ]
            // ],
            // [
            //     'attribute'=>'installation_date_request',
            //     'format'=>['date',(isset(Yii::$app->modules['datecontrol']['displaySettings']['date'])) ? Yii::$app->modules['datecontrol']['displaySettings']['date'] : 'd-m-Y'],
            //     'type'=>DetailView::INPUT_WIDGET,
            //     'widgetOptions'=> [
            //         'class'=>DateControl::classname(),
            //         'type'=>DateControl::FORMAT_DATE
            //     ]
            // ],
            // //'machine_delivery_direction_id',
            // $model->machineDeliveryDirection->option == null ? ['visible'=>false] : ['attribute'=>'machine_delivery_direction_id', 'value'=>$model->machineDeliveryDirection->option],
           
            // 'main_power_supply',
            // 'customer_product_details:ntext',
            // //'material_for_machine_testing_id',

            // 'material_specification_details:ntext',
            // 'machine_accessories',
            // 'special_requirement:ntext',
            // 'FOC_item:ntext',
            // 'warranty_term_from_supplier',
            // 'warranty_term_to_customer',
            // 'free_service',
            // 'total_free_service_per_year',
            // 'period_of_rental',
            // 'period_of_demo',
            // 'problem_report_by_customer:ntext',
            // 'purpose',
            // 'additional_comments:ntext',
            //'request_status_id',
        ],
        'deleteOptions'=>[
        'url'=>['delete', 'id' => $model->id],
        'data'=>[
        'confirm'=>Yii::t('app', 'Are you sure you want to delete this item?'),
        'method'=>'post',
        ],
        ],
        'enableEditMode'=>false,
    ]) ?>

</div>
