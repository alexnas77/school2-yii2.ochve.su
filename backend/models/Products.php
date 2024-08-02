<?php

namespace backend\models;

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
            [['category_id', 'category_name', 'discount', 'used', 'quantity', 'delivery', 'enabled', 'order_num'], 'integer'],
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
}
