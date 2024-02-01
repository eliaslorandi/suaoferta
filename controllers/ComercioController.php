<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\ImagemOferta;
use app\models\User;

class ComercioController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionComercios()
    {
        $comercios = user::find()->all();
        return $this->render('comercios', [
            'comercios' => $comercios,
        ]);
    }

    public function actionEstabelecimentos()
    {
        $estabelecimentos = user::find()->all();
        return $this->render('comercios', [
            'estabelecimentos' => $estabelecimentos,
        ]);
    }

    public function actionOfertasComercios()
    {
        $imagensOferta = ImagemOferta::find()->all();
        //return var_dump($arquivos);
        return $this->render('ofertasComercios', [
            'imagensOferta' => $imagensOferta, // Passando os dados das imagens para a view
        ]);
    }
}
