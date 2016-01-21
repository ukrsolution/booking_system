<?php

namespace app\controllers;

use Yii;
use app\models\TourField;
use app\models\TourFieldSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TourFieldController implements the CRUD actions for TourField model.
 */
class TourFieldController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all TourField models.
     * @return mixed
     */
    public function actionIndex($id=NULL)
    {
        $searchModel = new TourFieldSearch();
        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //print '<pre>'; print_r(['TourFieldSearch' => array('tour_id'=>1), 'r' => 'tour-field/index']);die();
        $searchParam = ['TourFieldSearch' => array('tour_id'=>$id), 'r' => 'tour-field/index'];
        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider = $searchModel->search($searchParam);
        
        $tourModel = \app\models\Tour::findOne($id);
        //$tourModel->title;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'id' => $id,
            'tourModel' => $tourModel,
        ]);
    }

    /**
     * Displays a single TourField model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $model = $this->findModel($id);
        $tourModel = \app\models\Tour::findOne(['id' => $model->tour_id]);
        return $this->render('view', [
            'model' => $model,
            'tourModel' => $tourModel,
        ]);
    }

    /**
     * Creates a new TourField model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id)
    {
        $model = new TourField();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->tour_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'id' => $id,
            ]);
        }
    }

    /**
     * Updates an existing TourField model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $tourModel = \app\models\Tour::findOne(['id' => $model->tour_id]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'id' => $model->tour_id,
                'tourModel' => $tourModel,
            ]);
        }
    }

    /**
     * Deletes an existing TourField model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $tour_id = $this->findModel($id)->tour_id;
        $this->findModel($id)->delete();

        return $this->redirect(['index', 'id' => $tour_id]);
    }

    /**
     * Finds the TourField model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TourField the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TourField::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
