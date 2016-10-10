<?php

namespace app\modules\contracts\controllers;

use Yii;
use app\modules\contracts\models\Contracts;
use app\modules\contracts\models\ContractsSearch;
use app\modules\contracts\models\ClientsCearch;
use app\modules\contracts\models\DevicesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use kartik\mpdf\Pdf;

/**
 * DefaultController implements the CRUD actions for Contracts model.
 */
class DefaultController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index','view','create','update','delete'],
                'rules' => [
                    [
                        'actions' => ['index','view','create','update','delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Contracts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ContractsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
       // print_r($dataProvider);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Contracts model.
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
     * Creates a new Contracts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
       
        $clientSearchModel = new ClientsCearch();
        $clientDataProvider = $clientSearchModel->search(Yii::$app->request->queryParams);
        $deviceSearchModel = new DevicesSearch();
        $deviceDataProvider = $deviceSearchModel->search(Yii::$app->request->queryParams);
        $model = new Contracts();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'clientSearchModel' => $clientSearchModel,
                'clientDataProvider' => $clientDataProvider,
                'deviceSearchModel' => $deviceSearchModel,
                'deviceDataProvider' => $deviceDataProvider,

            ]);
        }
    }

    /**
     * Updates an existing Contracts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $clientSearchModel = new ClientsCearch();
        $clientDataProvider = $clientSearchModel->search(Yii::$app->request->queryParams);
        $deviceSearchModel = new DevicesSearch();
        $deviceDataProvider = $deviceSearchModel->search(Yii::$app->request->queryParams);
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'clientSearchModel' => $clientSearchModel,
                'clientDataProvider' => $clientDataProvider,
                'deviceSearchModel' => $deviceSearchModel,
                'deviceDataProvider' => $deviceDataProvider,
                
            ]);
        }
    }

    /**
     * Deletes an existing Contracts model.
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
     * Finds the Contracts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Contracts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Contracts::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionPrintPreview($id)
    {
        return $this->renderPartial('print', [
            'model' => $this->findModel($id),
        ]);

    }

    public function actionPrint($id)
    {
 
        $content = $this->renderPartial('_print', [
            'model' => $this->findModel($id),
        ]);
        $pdf = new Pdf([
        // set to use core fonts only
            'mode' => '', 
            // A4 paper format
            'format' => Pdf::FORMAT_A4, 
             // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT, 
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER, 
            // your html content input
            'content' => $content,  
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting 
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => 'body {font-size:10px}', 
             // set mPDF properties on the fly
            'options' => ['title' => 'Contract'],
             // call mPDF methods on the fly
            'methods' => [ 
                 
                'SetFooter'=>['Стр. {PAGENO} из {nb}'],
            ]
        ]);
    
        // return the pdf output as per the destination setting
        return $pdf->render(); 

    }
}
