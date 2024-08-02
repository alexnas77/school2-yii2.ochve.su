<?php

namespace frontend\models;

/**
 * This is the ActiveQuery class for [[Products]].
 *
 * @see Products
 */
class ProductsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/
    
    public function classByDate($category_id, $dateSQL, $dateStart)
    {
        return $this->alias('p')
                ->select(['IFNULL(s.product_id, p.product_id) product_id',
's.date',
'IFNULL(s.category_id, p.category_id) category_id',
"(SELECT SUM(s2.delta) FROM stat s2 WHERE (s2.product_id = p.product_id) AND (s2.date BETWEEN '".$dateStart."' AND '".date("Y-m-d",strtotime("-1 day",strtotime($dateSQL)))."')) before",
's.breakfast_free',
's.breakfast',
's.lunch',
's.lunch2',
's.lunch3',
's.dinner',
's.lunch_m',
's.dinner_m',
's.cash',
's.card',
"(SELECT SUM(s2.delta) FROM stat s2 WHERE (s2.product_id = p.product_id) AND (s2.date BETWEEN '".$dateStart."' AND '".date("Y-m-d",strtotime("-1 day",strtotime($dateSQL)))."'))"
//. "+s.breakfast_free*s.new_breakfast_free"
//. "+s.breakfast*s.new_breakfast"            
//. "+s.lunch*s.new_lunch"             
//. "+s.lunch2*s.new_lunch2"           
//. "+s.dinner*s.new_dinner"           
//. "+s.lunch_m*s.new_lunch_m"          
//. "+s.dinner_m*s.new_dinner_m"         
//. "-s.cash"                
//. "-s.card" 
. "+IFNULL(s.delta,0)" 
. " after",
's.new_breakfast_free',
's.new_breakfast',
's.new_lunch',
's.new_lunch2',
's.new_lunch3',
's.new_dinner',
's.new_lunch_m',
's.new_dinner_m',
's.delta',
'p.model',
'c.name as category'])
                ->innerJoin('categories c', 'c.category_id = p.category_id')
                ->leftJoin('stat s', 's.product_id=p.product_id AND s.date = :date', ['date' => $dateSQL])
                ->where('(c.category_id = :category_id OR c.parent = :category_id2)',['category_id' => $category_id,'category_id2' => $category_id])
                ->andWhere('c.enabled = 1')
                ->andWhere('p.enabled = 1')
                ->groupBy('p.product_id')
                ->orderBy(['model' => SORT_ASC]);
    }

    /**
     * {@inheritdoc}
     * @return Products[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Products|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
