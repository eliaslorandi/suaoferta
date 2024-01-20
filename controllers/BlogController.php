<?php

namespace app\controllers;

class BlogController extends \yii\web\Controller
{
    public function actionComercios()
    {
        return $this->render('comercios');
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionOfertas()
    {
        return $this->render('ofertas');
    }

}
