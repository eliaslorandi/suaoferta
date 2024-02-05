<?php

namespace app\controllers;

use app\models\User;
use yii\web\Controller;

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

}
