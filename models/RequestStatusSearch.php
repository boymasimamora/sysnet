<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RequestStatus;

/**
 * RequestStatusSearch represents the model behind the search form about `app\models\RequestStatus`.
 */
class RequestStatusSearch extends RequestStatus
{
    public function rules()
    {
        return [
            [['id', 'followed_up_by_id', 'status'], 'integer'],
            [['follow_up_date', 'technician', 'scheduled_date', 'notes'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = RequestStatus::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'followed_up_by_id' => $this->followed_up_by_id,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'follow_up_date', $this->follow_up_date])
            ->andFilterWhere(['like', 'technician', $this->technician])
            ->andFilterWhere(['like', 'scheduled_date', $this->scheduled_date])
            ->andFilterWhere(['like', 'notes', $this->notes])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
