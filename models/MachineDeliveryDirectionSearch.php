<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MachineDeliveryDirection;

/**
 * MachineDeliveryDirectionSearch represents the model behind the search form about `app\models\MachineDeliveryDirection`.
 */
class MachineDeliveryDirectionSearch extends MachineDeliveryDirection
{
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['option'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = MachineDeliveryDirection::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'option', $this->option]);

        return $dataProvider;
    }
}
