<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property int $product_id
 * @property int $category_id
 * @property int $category_name
 * @property string $brand
 * @property string $code
 * @property string $model
 * @property float $price
 * @property string $currency_id
 * @property int $discount
 * @property string $guarantee
 * @property int $used
 * @property string|null $defects
 * @property string|null $description
 * @property string|null $body
 * @property int $quantity
 * @property int $delivery
 * @property int $enabled
 * @property string $hit
 * @property int $order_num
 */
class Products extends \yii\db\ActiveRecord
{
    public  $breakfast_free,
            $breakfast,
            $lunch,
            $lunch2,
            $lunch3,
            $dinner,
            $lunch_m,
            $dinner_m,
            $cash,
            $card,
            $new_breakfast_free,
            $new_breakfast,
            $new_lunch,
            $new_lunch2,
            $new_lunch3,
            $new_dinner,
            $new_lunch_m,
            $new_dinner_m,
            $delta,
            $before,
            $after;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'category_name', 'discount', 'used', 'quantity', 'delivery', 'enabled', 'order_num','lunch','lunch2','dinner','lunch_m','dinner_m'], 'integer'],
            [['price'], 'number'],
            [['defects', 'description', 'body'], 'string'],
            [['brand', 'model', 'currency_id'], 'string', 'max' => 255],
            [['code'], 'string', 'max' => 127],
            [['guarantee'], 'string', 'max' => 50],
            [['hit'], 'string', 'max' => 32],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'product_id' => 'Product ID',
            'category_id' => 'Category ID',
            'category_name' => 'Category Name',
            'brand' => 'Brand',
            'code' => 'Code',
            'model' => 'Model',
            'price' => 'Price',
            'currency_id' => 'Currency ID',
            'discount' => 'Discount',
            'guarantee' => 'Guarantee',
            'used' => 'Used',
            'defects' => 'Defects',
            'description' => 'Description',
            'body' => 'Body',
            'quantity' => 'Quantity',
            'delivery' => 'Delivery',
            'enabled' => 'Enabled',
            'hit' => 'Hit',
            'order_num' => 'Order Num',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ProductsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductsQuery(get_called_class());
    }
}
