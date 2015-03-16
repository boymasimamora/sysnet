<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SalesRequest;

/**
 * SalesRequestSearch represents the model behind the search form about `app\models\SalesRequest`.
 */
class SalesRequestSearch extends SalesRequest
{
    public function rules()
    {
        return [
            [['id', 'request_type_id', 'customer_id', 'machine_delivery_direction_id', 'material_for_machine_testing_id', 'free_service', 'total_free_service_per_year', 'request_status_id', 'done'], 'integer'],
            [['submit_date', 'machine_arrival_date_estimation', 'delivery_date_request', 'installation_date_request', 'main_power_supply', 'customer_product_details', 'material_specification_details', 'machine_accessories', 'special_requirement', 'FOC_item', 'problem_report_by_customer', 'purpose', 'warranty_term_from_supplier', 'warranty_term_to_customer', 'additional_comments', 'request_type.type', 'user.email', 'customer.name', 'profile.name', 'request_status.scheduled_date', 'request_status.status', 'submit_by_id', 'period_of_rental', 'period_of_demo'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = SalesRequest::find()->orderBy(['follow_up_status'=>SORT_ASC,'done'=>SORT_ASC, 'id'=>SORT_ASC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['request_type.type'] = [
            'asc' => ['request_type.type' => SORT_ASC],
            'desc' => ['request_type.type' => SORT_DESC],
        ];
        $query->joinWith(['request_type']); 

        $dataProvider->sort->attributes['user.email'] = [
            'asc' => ['user.email' => SORT_ASC],
            'desc' => ['user.email' => SORT_DESC],
        ];
        $query->joinWith(['user']);

        $dataProvider->sort->attributes['customer.name'] = [
            'asc' => ['customer.name' => SORT_ASC],
            'desc' => ['customer.name' => SORT_DESC],
        ];
        $query->joinWith(['customer']);

        $dataProvider->sort->attributes['profile.name'] = [
            'asc' => ['profile.name' => SORT_ASC],
            'desc' => ['profile.name' => SORT_DESC],
        ];
        $query->joinWith(['profile']);

        $dataProvider->sort->attributes['request_status.scheduled_date'] = [
            'asc' => ['request_status.scheduled_date' => SORT_ASC],
            'desc' => ['request_status.scheduled_date' => SORT_DESC],
        ];
        $query->joinWith(['request_status']);

        $dataProvider->sort->attributes['request_status.status'] = [
            'asc' => ['request_status.status' => SORT_ASC],
            'desc' => ['request_status.status' => SORT_DESC],
        ];
        $query->joinWith(['request_status']);

        //$query->andWhere('request_status_id IS NULL');

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'request_type_id' => $this->request_type_id,
            'submit_date' => $this->submit_date,
            'submit_by_id' => $this->submit_by_id,
            'customer_id' => $this->customer_id,
            'machine_arrival_date_estimation' => $this->machine_arrival_date_estimation,
            'delivery_date_request' => $this->delivery_date_request,
            'installation_date_request' => $this->installation_date_request,
            'machine_delivery_direction_id' => $this->machine_delivery_direction_id,
            'material_for_machine_testing_id' => $this->material_for_machine_testing_id,
            //'warranty_term_from_supplier' => $this->warranty_term_from_supplier,
            //'warranty_term_to_customer' => $this->warranty_term_to_customer,
            'free_service' => $this->free_service,
            'total_free_service_per_year' => $this->total_free_service_per_year,
            'period_of_rental' => $this->period_of_rental,
            'period_of_demo' => $this->period_of_demo,
            'request_status_id' => $this->request_status_id,
            'done'=>$this->done,

        ]);

        $query->andFilterWhere(['like', 'main_power_supply', $this->main_power_supply])
            ->andFilterWhere(['like', 'customer_product_details', $this->customer_product_details])
            ->andFilterWhere(['like', 'material_specification_details', $this->material_specification_details])
            ->andFilterWhere(['like', 'machine_accessories', $this->machine_accessories])
            ->andFilterWhere(['like', 'special_requirement', $this->special_requirement])
            ->andFilterWhere(['like', 'FOC_item', $this->FOC_item])
            ->andFilterWhere(['like', 'problem_report_by_customer', $this->problem_report_by_customer])
            ->andFilterWhere(['like', 'purpose', $this->purpose])
            ->andFilterWhere(['like', 'additional_comments', $this->additional_comments])
            ->andFilterWhere(['like', 'warranty_term_to_customer', $this->warranty_term_to_customer])
            ->andFilterWhere(['like', 'warranty_term_from_supplier', $this->warranty_term_from_supplier])

            //->andFilterWhere(['like', 'submit_by_id', $this->getAttribute('user.email')])

            ->andFilterWhere(['like','request_type.type',$this->getAttribute('request_type.type')])
            ->andFilterWhere(['like','user.email',$this->getAttribute('user.email')])
            ->andFilterWhere(['like', 'customer.name', $this->getAttribute('customer.name')])
            ->andFilterWhere(['like', 'profile.name', $this->getAttribute('profile.name')])
            ->andFilterWhere(['like', 'request_status.scheduled_date', $this->getAttribute('request_status.scheduled_date')])
            ->andFilterWhere(['like', 'machine_type', $this->machine_type])
            ->andFilterWhere(['like', 'request_status.status', $this->getAttribute('request_status.status')]);
            

        return $dataProvider;
    }

    public function attributes()
    {
        // add related fields to searchable attributes
        return array_merge(parent::attributes(), ['request_type.type'], ['user.email'], ['customer.name'], ['profile.name'], ['request_status.scheduled_date'], ['request_status.status']);
        //return array_merge(parent::attributes(), ['user.username']);
    }
}
