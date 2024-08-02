<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "categories".
 *
 * @property int $category_id
 * @property int $parent
 * @property string $name
 * @property string $alies
 * @property string $title
 * @property string $title1
 * @property string $title2
 * @property string $title3
 * @property string $title4
 * @property string $title5
 * @property string $title6
 * @property string $title7
 * @property string $title8
 * @property string $title9
 * @property string|null $description
 * @property string|null $description1
 * @property string|null $description2
 * @property string|null $description3
 * @property string|null $description4
 * @property string|null $description5
 * @property string|null $description6
 * @property string|null $description7
 * @property string|null $description8
 * @property string|null $description9
 * @property string|null $toptext
 * @property string|null $brands
 * @property int $order_num
 * @property int $enabled
 */
class Categories extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['parent', 'order_num', 'enabled'], 'integer'],
            [['description', 'description1', 'description2', 'description3', 'description4', 'description5', 'description6', 'description7', 'description8', 'description9', 'toptext', 'brands'], 'string'],
            [['name', 'alies', 'title', 'title1', 'title2', 'title3', 'title4', 'title5', 'title6', 'title7', 'title8', 'title9'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'category_id' => 'Category ID',
            'parent' => 'Parent',
            'name' => 'Name',
            'alies' => 'Alies',
            'title' => 'Title',
            'title1' => 'Title1',
            'title2' => 'Title2',
            'title3' => 'Title3',
            'title4' => 'Title4',
            'title5' => 'Title5',
            'title6' => 'Title6',
            'title7' => 'Title7',
            'title8' => 'Title8',
            'title9' => 'Title9',
            'description' => 'Description',
            'description1' => 'Description1',
            'description2' => 'Description2',
            'description3' => 'Description3',
            'description4' => 'Description4',
            'description5' => 'Description5',
            'description6' => 'Description6',
            'description7' => 'Description7',
            'description8' => 'Description8',
            'description9' => 'Description9',
            'toptext' => 'Toptext',
            'brands' => 'Brands',
            'order_num' => 'Order Num',
            'enabled' => 'Enabled',
        ];
    }
}
