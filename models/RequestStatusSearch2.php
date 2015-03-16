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
            [['id', 'followed_up_by_id'], 'integer'],
            [['follow_up_date', 'notes'], 'safe'],
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
            'follow_up_date' => $this->follow_up_date,
            'followed_up_by_id' => $this->followed_up_by_id,
        ]);

        $query->andFilterWhere(['like', 'notes', $this->notes]);

        return $dataProvider;
    }
}
