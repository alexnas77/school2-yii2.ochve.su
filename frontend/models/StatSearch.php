<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Stat;

/**
 * StatSearch represents the model behind the search form of `frontend\models\Stat`.
 */
class StatSearch extends Stat
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'category_id', 'breakfast_free', 'breakfast', 'lunch', 'lunch2', 'lunch3', 'dinner', 'lunch_m', 'dinner_m'], 'integer'],
            [['date'], 'safe'],
            [['cash', 'card', 'new_breakfast_free', 'new_breakfast', 'new_lunch', 'new_lunch2', 'new_lunch3', 'new_dinner', 'new_lunch_m', 'new_dinner_m', 'delta'], 'number'],
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
        $query = Stat::find();

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
            'product_id' => $this->product_id,
            'date' => $this->date,
            'category_id' => $this->category_id,
            'breakfast_free' => $this->breakfast_free,
            'breakfast' => $this->breakfast,
            'lunch' => $this->lunch,
            'lunch2' => $this->lunch2,
            'lunch3' => $this->lunch3,
            'dinner' => $this->dinner,
            'lunch_m' => $this->lunch_m,
            'dinner_m' => $this->dinner_m,
            'cash' => $this->cash,
            'card' => $this->card,
            'new_breakfast_free' => $this->new_breakfast_free,
            'new_breakfast' => $this->new_breakfast,
            'new_lunch' => $this->new_lunch,
            'new_lunch2' => $this->new_lunch2,
            'new_lunch3' => $this->new_lunch3,
            'new_dinner' => $this->new_dinner,
            'new_lunch_m' => $this->new_lunch_m,
            'new_dinner_m' => $this->new_dinner_m,
            'delta' => $this->delta,
        ]);

        return $dataProvider;
    }
}
