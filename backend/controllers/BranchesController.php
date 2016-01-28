<?php

namespace backend\controllers;

use Yii;
use backend\models\Branches;
use backend\models\branchesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;
use yii\helpers\Json;
use yii\base\Object;
use yii\bootstrap\ActiveForm;

/**
 * BranchesController implements the CRUD actions for Branches model.
 */
class BranchesController extends Controller
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
     * Lists all Branches models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new branchesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if (\Yii::$app->request->post('hasEditable')) {
            $branchId=Yii::$app->request->post('editableKey');
            $branch=Branches::findOne($branchId);//查询这一条要修改的数据信息
            
            
            $out=Json::encode(['output'=>'','message'=>'']);//生成ajax信息
            $post=[];
            $posted=current($_POST['Branches']);//接收这一条修改信息，并且只获取数组中最后的key和元素值(原参数：Branches[4][branch_name] =>上的法撒旦aaa)
            $post['Branches']=$posted;
            
            if ($branch->load($post)){//如果加载数据成功
                $branch->save();//保存数据
                $output=current($posted);
                $out=Json::encode(['output'=>$output,'message'=>'']);
            }
            echo $out;
            return ;
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Branches model.
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
     * Creates a new Branches model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * 已经加了RBAC权限控制，if、else判断
     */
    public function actionCreate(){
        if (Yii::$app->user->can('create-branch')){
            $model = new Branches();
            
            if (\Yii::$app->request->isAjax && $model->load(\Yii::$app->request->post())){
                \Yii::$app->response->format='json';
                return ActiveForm::validate($model);
            }
            
            
            if ($model->load(Yii::$app->request->post()) ) {
                if ($model->save()){
                    echo 1;
                }else {
                    echo 0;
                }
                //return $this->redirect(['view', 'id' => $model->branch_id]);
            } else {
                return $this->renderAjax('create', [
                    'model' => $model,
                ]);
            }
        }else {
            throw new ForbiddenHttpException;
        }
    }
    
    
    /**
     * 
     */
    public function actionValidation(){
        $model = new Branches();
        if (\Yii::$app->request->isAjax && $model->load(\Yii::$app->request->post())){
            \Yii::$app->response->format='json';
            return ActiveForm::validate($model);
        }
    }
    /**
     * 读取excel
     */
    public function actionImportExcel(){
        $inputFile='uploads/branches_file.xlsx';
        
        try {
            $inputFileType=\PHPExcel_IOFactory::identify($inputFile);
            $objReader=\PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel=$objReader->load($inputFile);
        } catch (Exception $e) {
            die('error');
        }
        $sheet=$objPHPExcel->getSheet();
        $highestRow=$sheet->getHighestRow();
        $highestColumn=$sheet->getHighestColumn();
        for ($row=1;$row<=$highestRow;$row++){
            $rowData=$sheet->rangeToArray('A'.$row.':'.$highestColumn.$row,NULL,TRUE,FALSE);
            if ($row==1){
                continue;
            }
            $branch= new Branches();
            $branch_id=$rowData[0][0];
            $branch->companies_company_id=$rowData[0][1];
            $branch->branch_name=$rowData[0][2];
            $branch->branch_address=$rowData[0][3];
            $branch->branch_create_data=date('Y-m-d H:i:s');
            $branch->branch_status=$rowData[0][4];
            $branch->save();
            print_r($branch->getErrors());
        }
        die('success');
        
    }
    
    

    /**
     * Updates an existing Branches model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->branch_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Branches model.
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
     * Finds the Branches model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Branches the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Branches::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    /**
     * 
     */
    public function actionUpload(){
        $fileName = 'file';
        $uploadPath = 'uploads';
        
        if (isset($_FILES[$fileName])) {
            $file = \yii\web\UploadedFile::getInstanceByName($fileName);
        
            //Print file data
            //print_r($file);
        
            if ($file->saveAs($uploadPath . '/' . $file->name)) {
                //Now save file data to database
        
                echo \yii\helpers\Json::encode($file);
            }
        }else {
            return $this->render('upload');
        }
        
        return false;
    }
    /*
     * department添加的联动后台
     */
    public function actionLists($id){
        $countBranches=Branches::find()->where(['companies_company_id'=>$id])->count();
        $branches=Branches::find()->where(['companies_company_id'=>$id])->all();
        if($countBranches >0){
            foreach ($branches as $branch){
                echo "<option value='".$branch->branch_id."'>".$branch->branch_name."</option>";
            }
        }else {
            echo "<option>-</option>";
        }
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}
