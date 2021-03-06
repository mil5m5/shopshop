<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Product;

/**
 * ProductSearch represents the model behind the search form of `common\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'price'], 'integer'],
            [['image', 'title', 'description', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Product::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'price' => $this->price,
        ]);

        $query->andFilterWhere(['like', 'image', $this->image])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description]);

        if($this->created_at) {
            $startDayCreate = strtotime($this->created_at);
            $endDayCreate = strtotime($this->created_at)+86400;
            $query->andFilterWhere(['>', 'created_at', $startDayCreate])->
            andFilterWhere(['<', 'created_at', $endDayCreate]);
        }
        if($this->updated_at) {
            $startDayUpdate = strtotime($this->updated_at);
            $endDateUpdate = strtotime($this->updated_at)+86400;
            $query->andFilterWhere(['>', 'updated_at', $startDayUpdate])->
            andFilterWhere(['>', 'updated_at', $endDateUpdate]);
        }
        return $dataProvider;
    }
}
