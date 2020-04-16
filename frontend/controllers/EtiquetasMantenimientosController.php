<?php

namespace frontend\controllers;

use Yii;
use frontend\models\EtiquetasMantenimientos;
use frontend\models\EtiquetasMantenimientosSearch;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EtiquetasMantenimientosController implements the CRUD actions for EtiquetasMantenimientos model.
 */
class EtiquetasMantenimientosController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => [
                    'index', 'view', 'create', 'update', 'delete',
                ],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => [
                            'update'
                        ],
                        'roles' => ['p-etiquetas-mantenimientos-actualizar'],
                    ],
                    [
                        'allow' => true,
                        'actions' => [
                            'view'
                        ],
                        'roles' => ['p-etiquetas-mantenimientos-ver'],
                    ],
                    [
                        'allow' => true,
                        'actions' => [
                            'create'
                        ],
                        'roles' => ['p-etiquetas-mantenimientos-crear'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['delete'],
                        'roles' => ['p-etiquetas-mantenimientos-eliminar'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all EtiquetasMantenimientos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EtiquetasMantenimientosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single EtiquetasMantenimientos model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new EtiquetasMantenimientos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new EtiquetasMantenimientos();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Etiqueta de Mantenimiento creado correctamente.');
            return $this->redirect(['view', 'id' => $model->id]);
        }else{
            echo Yii::$app->ayudante->getErroresSave($model);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing EtiquetasMantenimientos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing EtiquetasMantenimientos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        try {
            $this->findModel($id)->delete();
        } catch (yii\db\Exception $e) {
            Yii::$app->session->setFlash('danger', 'No puede eliminar este registro, se deben eliminar los registros asociados antes.');
        }
        return $this->redirect(['index']);
    }
    /**
     * Finds the EtiquetasMantenimientos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EtiquetasMantenimientos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EtiquetasMantenimientos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Ajax para la carga de las etiquetas en el select2 que esta 
     * en el formulario de Ordenes de Trabajos
     */
    /*     * ***********
     * Controller
     * ********** */
    public function actionEtiquetasMantenimientosList($q = null, $id = null) {
        return Yii::$app->ayudante->getSelectAjax($q, $id, 'id, nombre AS text', 'etiquetas_mantenimientos');
    }
}
