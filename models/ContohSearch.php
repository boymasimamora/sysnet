<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Contoh;

/**
 * ContohSearch represents the model behind the search form about `app\models\Contoh`.
 */
class ContohSearch extends Contoh
{
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['picture'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Contoh::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'picture', $this->picture]);

        return $dataProvider;
    }
}
