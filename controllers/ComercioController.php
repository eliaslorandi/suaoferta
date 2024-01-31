<?php

namespace app\controllers;

class ComercioController extends \yii\web\Controller
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
        return $this->render('ofertasComercios');
    }
    
}
