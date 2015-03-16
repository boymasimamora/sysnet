<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ServiceReport;

/**
 * ServiceReportSearch represents the model behind the search form about `app\models\ServiceReport`.
 */
class ServiceReportSearch extends ServiceReport
{
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['submit_date', 'reported_by', 'report_detail'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = ServiceReport::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'submit_date' => $this->submit_date,
        ]);

        $query->andFilterWhere(['like', 'reported_by', $this->reported_by])
            ->andFilterWhere(['like', 'report_detail', $this->report_detail]);

        return $dataProvider;
    }
}
