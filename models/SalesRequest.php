<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "sales_request".
 *
 * @property integer $id
 * @property integer $request_type_id
 * @property string $submit_date
 * @property integer $submit_by_id
 * @property integer $customer_id
 * @property string $machine_arrival_date_estimation
 * @property string $delivery_date_request
 * @property string $installation_date_request
 * @property integer $machine_delivery_direction_id
 * @property string $main_power_supply
 * @property string $customer_product_details
 * @property integer $material_for_machine_testing_id
 * @property string $material_specification_details
 * @property string $machine_accessories
 * @property string $special_requirement
 * @property string $FOC_item
 * @property integer $warranty_term_from_supplier
 * @property integer $warranty_term_to_customer
 * @property integer $free_service
 * @property integer $total_free_service_per_year
 * @property integer $period_of_rental
 * @property integer $period_of_demo
 * @property string $problem_report_by_customer
 * @property string $purpose
 * @property string $additional_comments
 * @property integer $request_status_id
 *
 * @property RequestType $requestType
 * @property Customer $customer
 * @property MachineDeliveryDirection $machineDeliveryDirection
 * @property MaterialForMachineTesting $materialForMachineTesting
 * @property RequestStatus $requestStatus
 * @property User $submitBy
 */
class SalesRequest extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sales_request';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['request_type_id', 'submit_by_id', 'customer_id', 'machine_delivery_direction_id', 'material_for_machine_testing_id', 'free_service', 'total_free_service_per_year', 'request_status_id', 'duration', 'done'], 'integer'],
            [['submit_date', 'submit_by_id'], 'required'],
            [['machine_arrival_date_estimation', 'delivery_date_request', 'installation_date_request'], 'safe'],
            [['customer_product_details', 'material_specification_details', 'special_requirement', 'FOC_item', 'problem_report_by_customer', 'additional_comments', 'purpose'], 'string'],
            [['submit_date', 'main_power_supply', 'machine_accessories', 'customer_contact_person', 'customer_contact_number', 'warranty_term_from_supplier', 'warranty_term_to_customer', 'period_of_rental', 'period_of_demo'], 'string', 'max' => 50],
            [['machine_type'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'request_type_id' => Yii::t('app', 'Request Type'),
            'submit_date' => Yii::t('app', 'Submit Date'),
            'submit_by_id' => Yii::t('app', 'Requestor'),
            'customer_id' => Yii::t('app', 'Customer'),
                'customer_contact_person'=>Yii::t('app', 'Contact Person'),
                'customer_contact_number'=>Yii::t('app', 'Contact Number'),
            'machine_arrival_date_estimation' => Yii::t('app', 'Machine Arrival Date Estimation'),
            'delivery_date_request' => Yii::t('app', 'Delivery Date Request'),
            'installation_date_request' => Yii::t('app', 'Installation Date Request'),

                'duration' => Yii::t('app', 'Duration'),
                'machine_type' => Yii::t('app', 'Machine Type'),

            'machine_delivery_direction_id' => Yii::t('app', 'Machine Delivery Direction'),
            'main_power_supply' => Yii::t('app', 'Main Power Supply'),
            'customer_product_details' => Yii::t('app', 'Customer Product Details'),
            'material_for_machine_testing_id' => Yii::t('app', 'Material For Machine Testing'),
            'material_specification_details' => Yii::t('app', 'Material Specification Details'),
            'machine_accessories' => Yii::t('app', 'Machine Accessories'),
            'special_requirement' => Yii::t('app', 'Special Requirement'),
            'FOC_item' => Yii::t('app', 'FOC Item'),
            'warranty_term_from_supplier' => Yii::t('app', 'Warranty Term From Supplier'),
            'warranty_term_to_customer' => Yii::t('app', 'Warranty Term To Customer'),
            'free_service' => Yii::t('app', 'Free Service'),
            'total_free_service_per_year' => Yii::t('app', 'Total Free Service Per Year'),
            'period_of_rental' => Yii::t('app', 'Period Of Rental'),
            'period_of_demo' => Yii::t('app', 'Period Of Demo'),
            'problem_report_by_customer' => Yii::t('app', 'Problem Report By Customer'),
            'purpose' => Yii::t('app', 'Purpose'),
            'additional_comments' => Yii::t('app', 'Additional Comments'),
            'request_status_id' => Yii::t('app', 'Request Status ID'),

                'request_type.type' => Yii::t('app', 'Request Type'),
                'user.email' => Yii::t('app', 'Requestor'),
                'customer.name' => Yii::t('app', 'Customer'),
                'profile.name' => Yii::t('app', 'Requestor'),
                'request_status.scheduled_date' => Yii::t('app', 'Scheduled Date'),
                'request_status.status' => Yii::t('app', 'Request Status'),

                'done'=>Yii::t('app', 'Request Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequest_type()
    {
        return $this->hasOne(RequestType::className(), ['id' => 'request_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMachineDeliveryDirection()
    {
        return $this->hasOne(MachineDeliveryDirection::className(), ['id' => 'machine_delivery_direction_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMaterialForMachineTesting()
    {
        return $this->hasOne(MaterialForMachineTesting::className(), ['id' => 'material_for_machine_testing_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    /*public function getRequestStatus()
    {
        return $this->hasOne(RequestStatus::className(), ['id' => 'request_status_id']);
    }*/

    public function getRequest_status()
    {
        return $this->hasOne(RequestStatus::className(), ['id' => 'request_status_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        $modeluser = new \dektrium\user\models\User;
        return $this->hasOne($modeluser, ['id' => 'submit_by_id']);
    }

    public function getProfile()
    {
        $modelprofile = new \dektrium\user\models\Profile;
        return $this->hasOne($modelprofile, ['user_id'=>'submit_by_id']);
    }

    public function getRequestTypeList() { // could be a static func as well
        $models = RequestType::find()->asArray()->all();
        return ArrayHelper::map($models, 'id', 'type');
    }

    public function getCustomerList() { // could be a static func as well
        $models = Customer::find()->asArray()->all();
        return ArrayHelper::map($models, 'id', 'name');
    }

    public function getMachineDirectionList() { // could be a static func as well
        $models = MachineDeliveryDirection::find()->asArray()->all();
        return ArrayHelper::map($models, 'id', 'option');
    }

    public function getMaterialMachineList() { // could be a static func as well
        $models = MaterialForMachineTesting::find()->asArray()->all();
        return ArrayHelper::map($models, 'id', 'option');
    }
}
