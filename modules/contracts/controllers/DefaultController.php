<?php

namespace app\modules\contracts\controllers;

use Yii;
use app\modules\contracts\models\Contracts;
use app\modules\contracts\models\SearchContracts;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
//use kartik\mpdf\Pdf;
//use codemix\yii2Excelexport;
//use mikehaertl\phpTmpfile;
//use app\models\GoogleDrive;
use app\models\User;
use app\models\Excell;
use app\models\ExportPdf;

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
                            return (Yii::$app->user->identity->role == User::ROLE_ADMIN  && Yii::$app->user->identity->status == User::STATUS_ACTIVE);
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
        if (Yii::$app->user->identity->role != User::ROLE_ADMIN){
            $dataProvider->query->andWhere(['id_user' => Yii::$app->user->identity->id]);
            $dataProvider->query->andWhere(['>', 'date_create', time() - 60*60]);

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


    /**
    * Вывод контракта в pdf
    */
    public function actionPrint($id)
    {

        $content = $this->renderPartial('_printRoman', [
            'model' => $this->findModel($id),
        ]);

        return ExportPdf::export($content);

    }


    /**
    * Предпросмотр контракта в html (для отладки)
    */
    public function actionPreview($id) {

        return $this->renderPartial('_printRoman', [
            'model' => $this->findModel($id),
        ]);

    }

    /**
    * вывод списка котрактов в ексель и на скачивание - в отладочных целях
    */
    public function actionExcell()
    {

        Excell::download();
    }

    /**
    * вывод списка котрактов в ексель и експорт в Google Drive
    */
    public function actionExport()
    {

        Excell::toGoogleDrive();

        return $this->render('export');

    }


}
