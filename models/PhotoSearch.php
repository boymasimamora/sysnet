<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Photo;

/**
 * PhotoSearch represents the model behind the search form about `app\models\Photo`.
 */
class PhotoSearch extends Photo
{
    public function rules()
    {
        return [
            [['id', 'album_id'], 'integer'],
            [['path', 'title', 'caption'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Photo::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'album_id' => $this->album_id,
        ]);

        $query->andFilterWhere(['like', 'path', $this->path])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'caption', $this->caption]);

        return $dataProvider;
    }
}
