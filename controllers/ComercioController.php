<?php

namespace app\controllers;

class ComercioController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionOferta()
    {
        return $this->render('oferta');
    }

    public function actionComercios()
    {
        return $this->render('comercios');
    }
    
}
