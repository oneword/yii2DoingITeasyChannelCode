<?php

namespace backend\controllers;

use Yii;
use backend\models\Po;
use backend\models\PoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\base\Object;
use backend\models\PoItem;
use yii\helpers\ArrayHelper;
use backend\models\Model;

/**
 * PoController implements the CRUD actions for Po model.
 */
class PoController extends Controller
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
     * Lists all Po models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Po model.
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
     * Creates a new Po model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate(){
        $model = new Po();
        $modelsPoItem = [new PoItem()];

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $oldIDs = ArrayHelper::map($modelsPoItem, 'id', 'id');
            $modelsPoItem = Model::createMultiple(PoItem::classname(), $modelsPoItem);
            echo PoItem::classname();
            echo '<pre>';
            print_r($modelsPoItem);
            print_r($oldIDs);
            echo '</pre>';
            die();
            Model::loadMultiple($modelsPoItem, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsPoItem, 'id', 'id')));
            // ajax validation
//             if (Yii::$app->request->isAjax) {
//                 Yii::$app->response->format = Response::FORMAT_JSON;
//                 return ArrayHelper::merge(
//                     ActiveForm::validateMultiple($modelsPoItem),
//                     ActiveForm::validate($modelCustomer)
//                 );
//             }
            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsPoItem) && $valid;
//             echo '<pre>';
//             print_r($valid);
//             echo '</pre>';
//             die();
            
            
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (! empty($deletedIDs)) {
                            PoItem::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($modelsPoItem as $modelPoItem) {
                            $modelPoItem->po_id = $model->id;
                            if (! ($flag = $modelPoItem->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
            
            
        } else {
            return $this->render('create', [
                'model' => $model,
                'modelsPoItem'=>(empty($modelsPoItem)) ? [new PoItem()] : $modelsPoItem,
            ]);
        }
    }

    /**
     * Updates an existing Po model.
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
     * Deletes an existing Po model.
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
     * Finds the Po model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Po the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Po::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
