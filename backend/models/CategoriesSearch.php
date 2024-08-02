<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Categories;

/**
 * CategoriesSearch represents the model behind the search form of `app\models\Categories`.
 */
class CategoriesSearch extends Categories
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'parent', 'order_num', 'enabled'], 'integer'],
            [['name', 'alies', 'title', 'title1', 'title2', 'title3', 'title4', 'title5', 'title6', 'title7', 'title8', 'title9', 'description', 'description1', 'description2', 'description3', 'description4', 'description5', 'description6', 'description7', 'description8', 'description9', 'toptext', 'brands'], 'safe'],
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
        $query = Categories::find();

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
            'category_id' => $this->category_id,
            'parent' => $this->parent,
            'order_num' => $this->order_num,
            'enabled' => $this->enabled,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'alies', $this->alies])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'title1', $this->title1])
            ->andFilterWhere(['like', 'title2', $this->title2])
            ->andFilterWhere(['like', 'title3', $this->title3])
            ->andFilterWhere(['like', 'title4', $this->title4])
            ->andFilterWhere(['like', 'title5', $this->title5])
            ->andFilterWhere(['like', 'title6', $this->title6])
            ->andFilterWhere(['like', 'title7', $this->title7])
            ->andFilterWhere(['like', 'title8', $this->title8])
            ->andFilterWhere(['like', 'title9', $this->title9])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'description1', $this->description1])
            ->andFilterWhere(['like', 'description2', $this->description2])
            ->andFilterWhere(['like', 'description3', $this->description3])
            ->andFilterWhere(['like', 'description4', $this->description4])
            ->andFilterWhere(['like', 'description5', $this->description5])
            ->andFilterWhere(['like', 'description6', $this->description6])
            ->andFilterWhere(['like', 'description7', $this->description7])
            ->andFilterWhere(['like', 'description8', $this->description8])
            ->andFilterWhere(['like', 'description9', $this->description9])
            ->andFilterWhere(['like', 'toptext', $this->toptext])
            ->andFilterWhere(['like', 'brands', $this->brands]);

        return $dataProvider;
    }
}
