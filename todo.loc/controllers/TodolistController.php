<?php

namespace app\controllers;

use Yii;
use app\models\Todolist;
use app\models\Comments;
use app\models\TodolistSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TodolistController implements the CRUD actions for Todolist model.
 */
class TodolistController extends Controller
{
    /**
     * Lists all Todolist models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TodolistSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'model' => new Todolist(),
        ]);
    }

    /**
     * Lists all Todolist models.
     * @return mixed
     */
    public function actionRefreshtable()
    {
        $searchModel = new TodolistSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->renderPartial('table', [
            'dataProvider' => $dataProvider,
            'model' => new Todolist(),
        ]);
    }

    /**
     * Displays a single Todolist model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
    	//$commentsList = Comments::find()->where(['task_id' => $id])->orderBy(['postdate' => SORT_DESC])->all();
    	$commentsModel = new Comments();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'commentsModel' => $commentsModel,
        ]);
    }

    /**
     * Creates a new Todolist model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
    	$this->enableCsrfValidation = false;
        $model = new Todolist();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->actionRefreshtable();
        } 
    }

    /**
     * Deletes an existing Todolist model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionChangestatus($id)
    {
        $model = $this->findModel($id);
        $model->status = 1;
        $model->save();

        /**
         * it is wrong to return empty, but in this case no deed to return something else
         */
        return;
    }

    /**
     * Finds the Todolist model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Todolist the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Todolist::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
