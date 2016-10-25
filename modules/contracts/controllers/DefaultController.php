<?php

namespace app\modules\contracts\controllers;

use Yii;
use app\modules\contracts\models\Contracts;
use app\modules\contracts\models\SearchContracts;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use kartik\mpdf\Pdf;
use codemix\yii2Excelexport;
use mikehaertl\phpTmpfile;
use app\models\GoogleDrive;

/**
 * DefaultController implements the CRUD actions for Contracts model.
 */
class DefaultController extends Controller
{
   //private $uploadFile = 'upload/contracts.xlsx';
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
                'only' => ['index','view','create','update','delete', 'print', 'printPreview', 'excell', 'export'],
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'create', 'print', 'printPreview'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['update', 'delete', 'excell', 'export'],
                        'allow' => true,
                        'matchCallback' => function($rule, $action){
                            return Yii::$app->user->identity->id==1;
                        },
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
        Yii::info(print_r($params,true));
        $searchModel = new SearchContracts();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        //если юсер не админ, то только свои контракты
        if (Yii::$app->user->identity->id!=1){
            $dataProvider->query->andWhere(['id_user'=>Yii::$app->user->identity->id]);
            $dataProvider->query->andWhere(['date'=> date('Y-m-d', time())]);

        }
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
        $model = new Contracts();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
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

    public function actionPrint($id)
    {

        $content = $this->renderPartial('_printRoman', [
            'model' => $this->findModel($id),
        ]);
        $pdf = new Pdf([
        // set to use core fonts only
            'mode' => 'Pdf::MODE_CORE', 
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

        public function actionExcell()
    {
        $file = \Yii::createObject([
            'class' => 'codemix\excelexport\ExcelFile',

            'writer' => '\PHPExcel_Writer_Excel2007', // Override default of `\PHPExcel_Writer_Excel2007`
            'sheets' => [
                'Contracts' => [
                    'class' => 'codemix\excelexport\ActiveExcelSheet',
                    'query' => Contracts::find(),

                    // If not specified, all attributes from `User::attributes()` are used
                    'attributes' => [
                        'id',
                        'date',
                        'name',
                        'passport',
                        'phone',    
                        'manufacturer',
                        'model',
                        'imei',
                        'price',
                        'sum',
                        'percent',
                        'user.display_name',

                    ],

                    // If not specified, the label from the respective record is used.
                    // You can also override single titles, like here for the above `team.name`
                    // 'titles' => [
                    //     'D' => 'Team Name',
                    // ],
                    'batchSize' => 100000, 
                ],



            ],



        ]);
        $phpExcell = $file->getWorkbook();

        // $phpExcell->getSheet(0)->getColumnDimensionByColumn(1)->setAutoSize(false);
        // $phpExcell->getSheet(0)->getColumnDimensionByColumn(1)->setWidth(15);
        foreach (range(0, 11) as $col) {
            $phpExcell
                    ->getSheet(0)
                    ->getColumnDimensionByColumn($col)
                    ->setAutoSize(true);
        }
        $file->send('demo.xlsx');
    }

    public function actionPreview($id) {

        return $this->renderPartial('_printRoman', [
            'model' => $this->findModel($id),
        ]);

    }



    public function actionExport()
    {
        $file = \Yii::createObject([
            'class' => 'codemix\excelexport\ExcelFile',

            'writer' => '\PHPExcel_Writer_Excel2007', // Override default of `\PHPExcel_Writer_Excel2007`
            'sheets' => [
                'Contracts' => [
                    'class' => 'codemix\excelexport\ActiveExcelSheet',
                    'query' => Contracts::find(),
                    'attributes' => [
                        'id',
                        'date',
                        'name',
                        'passport',
                        'phone',    
                        'manufacturer',
                        'model',
                        'imei',
                        'price',
                        'sum',
                        'percent',
                        'user.display_name',

                    ],
                    'batchSize' => 100000, 
                ],
            ],
        ]);
        $phpExcell = $file->getWorkbook();
        foreach (range(0, 11) as $col) {
            $phpExcell
                    ->getSheet(0)
                    ->getColumnDimensionByColumn($col)
                    ->setAutoSize(true);
        }
        
        $file->saveAs('upload/contracts.xlsx');
        GoogleDrive::saveFile('upload/contracts.xlsx');

        return $this->render('export');

    }


}
