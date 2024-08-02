<?php

namespace frontend\controllers;

use frontend\models\Stat;
use frontend\models\StatSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\data\Sort;

/**
 * StatController implements the CRUD actions for Stat model.
 */
class StatController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Stat models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new StatSearch();
        //echo "\$this->request->queryParams = ". json_encode($this->request->queryParams, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Stat model.
     * @param int $product_id Product ID
     * @param string $date Date
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($product_id, $date)
    {
        return $this->render('view', [
            'model' => $this->findModel($product_id, $date),
        ]);
    }

    /**
     * Creates a new Stat model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Stat();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'product_id' => $model->product_id, 'date' => $model->date]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Stat model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $product_id Product ID
     * @param string $date Date
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($product_id, $date)
    {
        $model = $this->findModel($product_id, $date);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'product_id' => $model->product_id, 'date' => $model->date]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Stat model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $product_id Product ID
     * @param string $date Date
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($product_id, $date)
    {
        $this->findModel($product_id, $date)->delete();

        return $this->redirect(['index']);
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
            return $this->redirect(['stat/'.$post['category_id'].'/'.$post['date']]);
        } else {
            return $this->redirect(['index']);
        }
        
        
    }

    /**
     * Class list.
     * @return string|\yii\web\Response
     */
    public function actionClass($category_id, $date)
    {
        $dateFormat = \DateTime::createFromFormat('d.m.Y', $date);
        
        $dateSQL = is_object($dateFormat) ? $dateFormat->format('Y-m-d') : date('Y-m-d');   
        
        $dateStart = \frontend\models\Settings::find()->select('value')->where(['name' => 'start'])->asArray()->one();
        
        //error_log(print_r($dateStart, 1));
        
        /*$sumBefore = (new \yii\db\Query())
                    ->from(['stat s2'])
                    ->where('s2.product_id = s.product_id')
                    ->andWhere('s2.date BETWEEN :start AND :end',['start' => $dateStart['value'],'end' => date("Y-m-d",strtotime("-1 day",strtotime($dateSQL)))])
                    ->sum('s2.delta');
        error_log(print_r($sumBefore, 1));*/
        
        /*$query = (new \yii\db\Query())
                ->select(['IFNULL(s.product_id, p.product_id) product_id',
's.date',
'IFNULL(s.category_id, p.category_id) category_id',
"(SELECT SUM(s2.delta) FROM stat s2 WHERE (s2.product_id = s.product_id) AND (s2.date BETWEEN '".$dateStart['value']."' AND '".date("Y-m-d",strtotime("-1 day",strtotime($dateSQL)))."')) before",
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
"(SELECT SUM(s2.delta) FROM stat s2 WHERE (s2.product_id = s.product_id) AND (s2.date BETWEEN '".$dateStart['value']."' AND '".date("Y-m-d",strtotime("-1 day",strtotime($dateSQL)))."'))"
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
                ->from(['categories c','products p'])
                ->leftJoin('stat s', 's.product_id=p.product_id AND s.date = :date', ['date' => $dateSQL])
                ->where('c.category_id = p.category_id')
                ->andWhere('(c.category_id = :category_id OR c.parent = :category_id2)',['category_id' => $category_id,'category_id2' => $category_id])
                ->andWhere('c.enabled = 1')
                ->andWhere('p.enabled = 1')
                ->groupBy('p.product_id')
                ->orderBy(['model' => SORT_ASC]);*/
        
        $query = Stat::find()
                ->alias('s')
                ->select(['IFNULL(s.product_id, p.product_id) product_id',
's.date',
'IFNULL(s.category_id, p.category_id) category_id',
"(SELECT SUM(s2.delta) FROM stat s2 WHERE (s2.product_id = s.product_id) AND (s2.date BETWEEN '".$dateStart['value']."' AND '".date("Y-m-d",strtotime("-1 day",strtotime($dateSQL)))."')) before",
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
"(SELECT SUM(s2.delta) FROM stat s2 WHERE (s2.product_id = s.product_id) AND (s2.date BETWEEN '".$dateStart['value']."' AND '".date("Y-m-d",strtotime("-1 day",strtotime($dateSQL)))."'))"
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
                ->innerJoin('products p', 's.product_id=p.product_id AND s.date = :date', ['date' => $dateSQL])
                ->innerJoin('categories c', 'c.category_id = p.category_id')
                ->where('(c.category_id = :category_id OR c.parent = :category_id2)',['category_id' => $category_id,'category_id2' => $category_id])
                ->andWhere('c.enabled = 1')
                ->andWhere('p.enabled = 1')
                ->groupBy('p.product_id')
                ->orderBy(['model' => SORT_ASC]);
        
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
        
        //error_log(print_r($models, 1));
        
        $searchModel = new StatSearch();

        return $this->render('class', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'date' => $date,
            'model' => $models[0] ?? [],
        ]);
    }
    
    /**
     * Finds the Stat model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $product_id Product ID
     * @param string $date Date
     * @return Stat the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($product_id, $date)
    {
        if (($model = Stat::findOne(['product_id' => $product_id, 'date' => $date])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
