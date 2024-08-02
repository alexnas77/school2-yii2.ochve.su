<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Products;

/**
 * ProductsSearch represents the model behind the search form of `app\models\Products`.
 */
class ProductsSearch extends Products
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'category_id', 'category_name', 'discount', 'used', 'quantity', 'delivery', 'enabled', 'order_num'], 'integer'],
            [['brand', 'code', 'model', 'currency_id', 'guarantee', 'defects', 'description', 'body', 'hit'], 'safe'],
            [['price'], 'number'],
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
        $query = Products::find();

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
            'category_id' => $this->category_id,
            'category_name' => $this->category_name,
            'price' => $this->price,
            'discount' => $this->discount,
            'used' => $this->used,
            'quantity' => $this->quantity,
            'delivery' => $this->delivery,
            'enabled' => $this->enabled,
            'order_num' => $this->order_num,
        ]);

        $query->andFilterWhere(['like', 'brand', $this->brand])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'model', $this->model])
            ->andFilterWhere(['like', 'currency_id', $this->currency_id])
            ->andFilterWhere(['like', 'guarantee', $this->guarantee])
            ->andFilterWhere(['like', 'defects', $this->defects])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'body', $this->body])
            ->andFilterWhere(['like', 'hit', $this->hit]);

        return $dataProvider;
    }
}
