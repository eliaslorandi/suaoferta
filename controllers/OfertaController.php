<?php

namespace app\controllers;

use app\models\Arquivo;
use Yii;
use app\models\Oferta;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use app\models\ImagemOferta;
use app\models\OfertaSearch;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
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
                    'class' => AccessControl::class,
                    'only' => ['update', 'delete'], // Ações que deseja controlar o acesso
                    'rules' => [
                        [
                            'actions' => ['update', 'delete'],
                            'allow' => true,
                            'matchCallback' => function ($rule, $action) {
                                // Verificar se o usuário está logado
                                if (!Yii::$app->user->isGuest) {
                                    // Verificar se o usuário possui permissão para editar/deletar esta oferta
                                    $ofertaId = Yii::$app->request->get('id');
                                    $oferta = Oferta::findOne($ofertaId);
                                    if ($oferta !== null && $oferta->user_id === Yii::$app->user->identity->id) {
                                        return true; // Permite que o usuário edite/deleter sua própria oferta
                                    }
                                }
                                // Se não atender aos critérios acima, nega o acesso
                                throw new ForbiddenHttpException('Você não tem permissão para executar esta ação.');
                            },
                        ],
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
                $model->user_id = Yii::$app->user->id;
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
        //excluir imagens
        $this->actionExcluirImagemOferta($id);
        $this->actionExcluirArquivo($id);

        return $this->redirect(['oferta/index']);
    }

    public function actionExcluirImagemOferta()
    {
        if ($this->request->isPost) {
            $imagemId = $this->request->post('id');
            $imagem = ImagemOFerta::findOne($imagemId);
            if (!$imagem) {
                throw new NotFoundHttpException('Imagem não encontrada.');
            } else {
                if ($imagem->arquivo->delete()) {
                    $imagem->delete();
                    return 'Imagem excluída com sucesso.';
                } else {
                    return 'Erro ao excluir imagem.';
                }
            }
        } else {
            throw new NotFoundHttpException('Ação não permitida.');
        }
    }

    public function actionExcluirArquivo()
    {
        if ($this->request->isPost) {
            $arquivoId = $this->request->post('id');
            $arquivo = Arquivo::findOne($arquivoId);
            if (!$arquivo) {
                throw new NotFoundHttpException('Arquivo não encontrado.');
            } else {
                if ($arquivo->delete()) {
                    return 'Arquivo excluído com sucesso.';
                } else {
                    return 'Erro ao excluir arquivo.';
                }
            }
        }
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

        throw new NotFoundHttpException('Página não existente.');
    }
}
