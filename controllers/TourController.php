<?php

namespace app\controllers;

use Yii;
use app\models\Tour;
use app\models\TourSearch;
use app\models\TourFieldSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * TourController implements the CRUD actions for Tour model.
 */
class TourController extends Controller
{
   /* public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }*/
    
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                //'only' => ['login', 'logout', 'signup'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['list', 'book'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'reservations','list', 'book', 'delete-reservation', 'view-reservation'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Tour models.
     * @return mixed
     */
    public function actionIndex()
    {        
        $searchModel = new TourSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tour model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {            
        return $this->render('view', [
            'model' => $this->findModel($id),            
        ]);
    }

    /**
     * Creates a new Tour model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {       
        $model = new Tour();        
        
        if ($model->load(Yii::$app->request->post()) && $model->save() && $model->createDefaultFields($model->id)) {
            return $this->redirect(['view', 'id' => $model->id]);
            
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Tour model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {        
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Tour model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tour model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tour the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tour::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    //list of available Tours
    public function actionList()
    {   
        $searchModel = new TourSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);       
    }
    
    //Show created reservations
    public function actionReservations() {        
        $dataProvider = new \app\data\ReservationsProvider();
        return $this->render('reservations', [
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionViewReservation($id) {        
        $dataProvider = $this->getReservationFieldsProvider($id);
        return $this->render('reservation-fields', [
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionDeleteReservation($id)
    {
        \app\models\Book::findOne($id)->delete();

        return $this->redirect(['reservations']);
    }
    
    public function actionBook($id)
    {   $noPostData = true;
        $tourTitle = Tour::findOne($id)->title;
        
        $modelBook      = new \app\models\Book();        
        $modelTourFields = \app\models\TourField::find()->where(['tour_id' => $id])->orderBy('position')->all();        
        $modelBookValues = $this->getBookValuesArray(count($modelTourFields));
        
        //print '<pre>'; print_r(Yii::$app->request->post()); die();
        $BookValues = Yii::$app->request->post('BookValues');
        $ValuesType = Yii::$app->request->post('ValuesType');
        $Date       = Yii::$app->request->post('Date');        
        
        if ($BookValues && $ValuesType ) $noPostData = false;
        
        if (!$noPostData && Tour::validateReservationData($BookValues, $ValuesType)) {  
            
            if ($BookValues && $Date && $this->bookTour($modelBook, $id, $Date, $modelBookValues, $BookValues, $modelTourFields)) {            
                return $this->redirect(['list']);
            }                   
        } else {           
            return $this->render('book', [
                'modelBookValues' => $modelBookValues,
                'modelTourFields' => $modelTourFields,
                'modelBook'       => $modelBook,
                'tourTitle'       => $tourTitle,
                'success'         => $noPostData,
            ]);
        }                
    }
    
    protected function getBookValuesArray($numFields){
        $modelBookValues = array();
        while($numFields > 0){
            $modelBookValues[] = new \app\models\BookValue();
            $numFields--;
        }
        return $modelBookValues;
    }
    
    protected function bookTour($modelBook, $id, $Date, $modelBookValues, $BookValues, $modelTourFields) {
        $modelBook->tour_id = $id;
        $modelBook->date = $Date;
            
        if ($modelBook->save()){                
            $ok = true;
            foreach ($BookValues as $key => $value){
                $modelBookValues[$key]->book_id         = $modelBook->id;
                $modelBookValues[$key]->tour_field_id   = $modelTourFields[$key]->id;
                $modelBookValues[$key]->value           = $value;
                $ok = $modelBookValues[$key]->save();
            }
            return $ok;
        } else {
            return false;
        }
    }
    
    protected function getReservationFieldsProvider($id){
        $book = \app\models\Book::findOne($id);
        $tourFields = \app\models\TourField::find()->where(['tour_id' => $book->tour_id])->orderBy('position')->all();
        $bookValues = \app\models\BookValue::find()->where(['book_id' => $book->id])->indexBy('tour_field_id')->all();
        
        //print '<pre>'; print_r($tourFields); die();
        foreach ($tourFields as $field) {
            $data[]=['name' => $field->name,
                     'value' => array_key_exists($field->id, $bookValues) ? $bookValues[$field->id]->value : '',
                    ];
        }
        //print '<pre>'; print_r($data); die();
        $provider = new \yii\data\ArrayDataProvider([
            'allModels' => $data,        
        ]);
        
        return $provider;
    }    
}
