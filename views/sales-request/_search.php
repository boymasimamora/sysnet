<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\SalesRequestSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="sales-request-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'request_type_id') ?>

    <?= $form->field($model, 'submit_date') ?>

    <?= $form->field($model, 'submit_by_id') ?>

    <?= $form->field($model, 'customer_id') ?>

    <?php // echo $form->field($model, 'machine_arrival_date_estimation') ?>

    <?php // echo $form->field($model, 'delivery_date_request') ?>

    <?php // echo $form->field($model, 'installation_date_request') ?>

    <?php // echo $form->field($model, 'machine_delivery_direction_id') ?>

    <?php // echo $form->field($model, 'main_power_supply') ?>

    <?php // echo $form->field($model, 'customer_product_details') ?>

    <?php // echo $form->field($model, 'material_for_machine_testing_id') ?>

    <?php // echo $form->field($model, 'material_specification_details') ?>

    <?php // echo $form->field($model, 'machine_accessories') ?>

    <?php // echo $form->field($model, 'special_requirement') ?>

    <?php // echo $form->field($model, 'FOC_item') ?>

    <?php // echo $form->field($model, 'warranty_term_from_supplier') ?>

    <?php // echo $form->field($model, 'warranty_term_to_customer') ?>

    <?php // echo $form->field($model, 'free_service') ?>

    <?php // echo $form->field($model, 'total_free_service_per_year') ?>

    <?php // echo $form->field($model, 'period_of_rental') ?>

    <?php // echo $form->field($model, 'period_of_demo') ?>

    <?php // echo $form->field($model, 'problem_report_by_customer') ?>

    <?php // echo $form->field($model, 'purpose') ?>

    <?php // echo $form->field($model, 'additional_comments') ?>

    <?php // echo $form->field($model, 'request_status_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
