<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "stat".
 *
 * @property int $product_id
 * @property string $date
 * @property int $category_id
 * @property int $breakfast_free
 * @property int $breakfast
 * @property int $lunch
 * @property int $lunch2
 * @property int $lunch3
 * @property int $dinner
 * @property int $lunch_m
 * @property int $dinner_m
 * @property float $cash
 * @property float $card
 * @property float $new_breakfast_free
 * @property float $new_breakfast
 * @property float $new_lunch
 * @property float $new_lunch2
 * @property float $new_lunch3
 * @property float $new_dinner
 * @property float $new_lunch_m
 * @property float $new_dinner_m
 * @property float $delta
 */
class Stat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'date'], 'required'],
            [['product_id', 'category_id', 'breakfast_free', 'breakfast', 'lunch', 'lunch2', 'lunch3', 'dinner', 'lunch_m', 'dinner_m'], 'integer'],
            [['date'], 'safe'],
            [['cash', 'card', 'new_breakfast_free', 'new_breakfast', 'new_lunch', 'new_lunch2', 'new_lunch3', 'new_dinner', 'new_lunch_m', 'new_dinner_m', 'delta'], 'number'],
            [['product_id', 'date'], 'unique', 'targetAttribute' => ['product_id', 'date']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'product_id' => 'Product ID',
            'date' => 'Date',
            'category_id' => 'Category ID',
            'breakfast_free' => 'Breakfast Free',
            'breakfast' => 'Breakfast',
            'lunch' => 'Lunch',
            'lunch2' => 'Lunch2',
            'lunch3' => 'Lunch3',
            'dinner' => 'Dinner',
            'lunch_m' => 'Lunch M',
            'dinner_m' => 'Dinner M',
            'cash' => 'Cash',
            'card' => 'Card',
            'new_breakfast_free' => 'New Breakfast Free',
            'new_breakfast' => 'New Breakfast',
            'new_lunch' => 'New Lunch',
            'new_lunch2' => 'New Lunch2',
            'new_lunch3' => 'New Lunch3',
            'new_dinner' => 'New Dinner',
            'new_lunch_m' => 'New Lunch M',
            'new_dinner_m' => 'New Dinner M',
            'delta' => 'Delta',
        ];
    }

    /**
     * {@inheritdoc}
     * @return StatQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StatQuery(get_called_class());
    }
}
