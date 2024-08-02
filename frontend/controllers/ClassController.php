<?php

namespace frontend\controllers;

//use frontend\models\Stat;
use frontend\models\StatSearch;
use frontend\models\Products;
use frontend\models\Settings;
//use yii\web\Controller;
//use yii\web\NotFoundHttpException;
//use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
//use yii\data\Sort;
use yii\helpers\ArrayHelper;

class ClassController extends \yii\web\Controller
{
    public function actionEdit()
    {
        return $this->render('edit');
    }

    public function actionIndex($category_id, $date)
    {
        $dateFormat = \DateTime::createFromFormat('d.m.Y', $date);
        
        $dateSQL = is_object($dateFormat) ? $dateFormat->format('Y-m-d') : date('Y-m-d');   
        
        $dateStart = Settings::getParam('start');
        
        $dateTomorrowFormat = \DateTime::createFromFormat('d.m.Y', $date);
        
        $dateTomorrowFormat->add(new \DateInterval('P1D'));
        
        $dateTomorrow = $dateTomorrowFormat->format('d.m.Y');
        
        //error_log(print_r($dateStart, 1));
        
        /*$sumBefore = (new \yii\db\Query())
                    ->from(['stat s2'])
                    ->where('s2.product_id = s.product_id')
                    ->andWhere('s2.date BETWEEN :start AND :end',['start' => $dateStart['value'],'end' => date("Y-m-d",strtotime("-1 day",strtotime($dateSQL)))])
                    ->sum('s2.delta');
        error_log(print_r($sumBefore, 1));*/
        
        $query = (new \yii\db\Query())
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
                ->from(['categories c','products p'])
                ->leftJoin('stat s', 's.product_id=p.product_id AND s.date = :date', ['date' => $dateSQL])
                ->where('c.category_id = p.category_id')
                ->andWhere('(c.category_id = :category_id OR c.parent = :category_id2)',['category_id' => $category_id,'category_id2' => $category_id])
                ->andWhere('c.enabled = 1')
                ->andWhere('p.enabled = 1')
                ->groupBy('p.product_id')
                ->orderBy(['model' => SORT_ASC]);
        
        /*$query = Products::find()
                ->alias('p')
                ->select(['IFNULL(s.product_id, p.product_id) product_id',
's.date',
'IFNULL(s.category_id, p.category_id) category_id',
"(SELECT SUM(s2.delta) FROM stat s2 WHERE (s2.product_id = s.product_id) AND (s2.date BETWEEN '".$dateStart."' AND '".date("Y-m-d",strtotime("-1 day",strtotime($dateSQL)))."')) before",
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
"(SELECT SUM(s2.delta) FROM stat s2 WHERE (s2.product_id = s.product_id) AND (s2.date BETWEEN '".$dateStart."' AND '".date("Y-m-d",strtotime("-1 day",strtotime($dateSQL)))."'))"
//. "+s.breakfast_free*s.new_breakfast_free"
//. "+s.breakfast*s.new_breakfast"            
//. "+s.lunch*s.new_lunch"             
//. "+s.lunch2*s.new_lunch2"           
//. "+s.dinner*s.new_dinner"           
//. "+s.lunch_m*s.new_lunch_m"          
//. "+s.dinner_m*s.new_dinner_m"         
//. "-s.cash"                
//. "-s.card" 
. "+s.delta" 
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
                ->joinWith([
                'stat s' => function ($query) use ($dateSQL) {
                $query->andWhere(['=', 's.date', $dateSQL]);
                }
                ])
                ->innerJoin('categories c', 'c.category_id = p.category_id')
                //->where('s.date = :date', ['date' => $dateSQL])
                ->andWhere('(c.category_id = :category_id OR c.parent = :category_id2)',['category_id' => $category_id,'category_id2' => $category_id])
                ->andWhere('c.enabled = 1')
                ->andWhere('p.enabled = 1')
                ->groupBy('p.product_id')
                ->orderBy(['model' => SORT_ASC]);
        $query = Products::find()->classByDate($category_id, $dateSQL, $dateStart);*/
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 50,
            ],
            /*'sort' => [
                'defaultOrder' => [
                    'model' => SORT_ASC, 
                ]
            ],*/
        ]);

        // возвращает массив данных
        $models = $dataProvider->getModels();
        
        $model = (object)($models[0] ?? []);
        
        foreach (['new_breakfast_free',
                'new_breakfast',
                'new_lunch',
                'new_lunch2',
                'new_lunch3',
                'new_dinner',
                'new_lunch_m',
                'new_dinner_m',] as $v) {
            if(!isset($model->$v) || empty($model->$v)) {
                $model->$v = floatval(Settings::getParam(str_replace("new_", "", $v)));
            }
        }
        
        //error_log(print_r($models, 1));
        
        $searchModel = new StatSearch();
        
        $footer_sum = (new \yii\db\Query())
                ->select(['s.date',
'IFNULL(s.category_id, p.category_id) category_id',
'SUM(s.breakfast_free) count_breakfast_free',
'SUM(s.breakfast) count_breakfast',
'SUM(s.lunch) count_lunch',
'SUM(s.lunch2) count_lunch2',
'SUM(s.lunch3) count_lunch3',
'SUM(s.dinner) count_dinner',
'SUM(s.lunch_m) count_lunch_m',
'SUM(s.dinner_m) count_dinner_m',
'if(SUM(s.cash)>0,(-1)*SUM(s.cash),0) sum_cash',
'if(SUM(s.card)>0,(-1)*SUM(s.card),0) sum_card',
'SUM(s.breakfast_free*s.new_breakfast_free) sum_breakfast_free',
'SUM(s.breakfast*s.new_breakfast) sum_breakfast',
'SUM(s.lunch*s.new_lunch) sum_lunch',
'SUM(s.lunch2*s.new_lunch2) sum_lunch2',
'SUM(s.lunch3*s.new_lunch3) sum_lunch3',
'SUM(s.dinner*s.new_dinner) sum_dinner',
'SUM(s.lunch_m*s.new_lunch_m) sum_lunch_m',
'SUM(s.dinner_m*s.new_dinner_m) sum_dinner_m'])
                ->from(['categories c','products p'])
                ->leftJoin('stat s', 's.product_id=p.product_id AND s.date = :date', ['date' => $dateSQL])
                ->where('c.category_id = p.category_id')
                ->andWhere('(c.category_id = :category_id OR c.parent = :category_id2)',['category_id' => $category_id,'category_id2' => $category_id])
                ->andWhere('c.enabled = 1')
                ->andWhere('p.enabled = 1')
                ->groupBy(['s.date','IFNULL(s.category_id, p.category_id)'])
                ->one();
        
        $footer_sum['sum_before'] = array_sum(ArrayHelper::getColumn($query->all(), 'before'));
        $footer_sum['sum_after'] = array_sum(ArrayHelper::getColumn($query->all(), 'after'));
        $footer_sum['sum_spent'] = array_sum([
            $footer_sum['sum_breakfast_free'],
            $footer_sum['sum_breakfast'],
            $footer_sum['sum_lunch'],
            $footer_sum['sum_lunch2'],
            $footer_sum['sum_lunch3'],
            $footer_sum['sum_lunch_m'],
            $footer_sum['sum_dinner_m'],
            ]);
        $footer_sum['sum_in'] = array_sum([
            $footer_sum['sum_cash'],
            $footer_sum['sum_card'],
            ]);
        
        //error_log(print_r($footer_sum, true));

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'date' => $date,
            'dateTomorrow' => $dateTomorrow,
            'model' => $model,
            'footer_sum' => $footer_sum,
        ]);
    }

    public function actionUpdate()
    {
        return $this->render('update');
    }

    /**
     * Redirect into one class and date list.
     * @return \yii\web\Response
     */
    public function actionRedirect()
    {        
        //echo "<pre>".json_encode($this->request->post(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)."<pre>";
        
        $post = $this->request->post();
        
        if(isset($post['category_id']) && isset($post['date'])) {
            return $this->redirect(['class/'.$post['category_id'].'/'.$post['date']]);
        } else {
            return $this->redirect(['index']);
        }
        
        
    }

}
