<?php

namespace app\controllers;

use Yii;
use app\models\Oferta;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use app\models\ImagemOferta;
use app\models\OfertaSearch;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use Symfony\Component\VarDumper\VarDumper;

//use GuzzleHttp\Psr7\UploadedFile;

/**
 * OfertaController implements the CRUD actions for Oferta model.
 */
class OfertaController extends Controller
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
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                        'excluir-imagem-oferta' => ['POST'],
                    ],
                ],
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['@'],
                        ]
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Oferta models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new OfertaSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Oferta model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Oferta model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Oferta();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->arquivoImagem = UploadedFile::getInstance($model, 'arquivoImagem');
                if ($model->save()) {
                    $model->saveImagem();
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Oferta model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->arquivoImagem = UploadedFile::getInstance($model, 'arquivoImagem');
            if ($model->save()) {
                $model->saveImagem();
                Yii::$app->session->SetFlash(key: 'success', value: 'Oferta atualizada com sucesso!');
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Oferta model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionExcluirImagemOferta()
    {
        $imagem = ImagemOferta::findOne($this->request->post('id'));
        if(!$imagem){
            throw new NotFoundHttpException('Imagem não encontrada');
        }
        if($imagem->arquivo->delete()){
            $path = Yii::$app->params['uploads']['ofertas'] . '/' . $imagem->arquivo->nome;
            unlink($path);
        }

        // $imagem = ImagemOferta::findOne($id);
        // if (!$imagem) {
        //     throw new NotFoundHttpException('Imagem não encontrada');
        // }
        // if ($imagem->arquivo->delete()) {
        //     $path = Yii::getAlias('@webroot') . Yii::$app->params['uploads']['ofertas'] . '/' . $imagem->arquivo->nome;
        //     if (file_exists($path)) {
        //         unlink($path);
        //     }
        //     $imagem->delete();
        //     Yii::$app->session->setFlash('success', 'Imagem excluída com sucesso.');
        // } else {
        //     Yii::$app->session->setFlash('error', 'Erro ao excluir a imagem.');
        // }

        // return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);

    }

    /**
     * Finds the Oferta model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Oferta the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Oferta::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
