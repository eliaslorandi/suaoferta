<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\ImagemOferta;

class ComercioController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionComercios()
    {
        return $this->render('comercios');
    }

    public function actionOfertasComercios()
    {
        // Supondo que você tenha um modelo de ImagemOferta para recuperar os dados das imagens
        $imagensOferta = ImagemOferta::find()->all();
        //return var_dump($arquivos);
        return $this->render('ofertasComercios', [
            'imagensOferta' => $imagensOferta, // Passando os dados das imagens para a view
        ]);
    }
}
