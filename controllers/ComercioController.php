<?php

namespace app\controllers;

use app\models\User;
use yii\web\Controller;

class ComercioController extends Controller
{
    public function actionIndex()
    {
        // Passo 1: Buscar todas as categorias disponíveis na tabela de usuários
        $categorias = User::find()->select('categoriaComercio')->distinct()->column();

        // Array para armazenar os comércios agrupados por categoria
        $comerciosPorCategoria = [];

        // Passo 2: Para cada categoria, buscar os comércios associados
        foreach ($categorias as $categoria) {
            $comerciosPorCategoria[$categoria] = User::find()->where(['categoriaComercio' => $categoria])->all();
        }

        // Renderiza a view 'comercio/comercios.php' passando as categorias e os comércios agrupados por categoria
        return $this->render('index', [
            'categorias' => $categorias,
            'comerciosPorCategoria' => $comerciosPorCategoria,
        ]);
        //return $this->render('index');
    }

    public function actionComercios()
    {
        $comercios = User::find()->all();
        return $this->render('index', [
            'comercios' => $comercios,
        ]);
    }

    
}
