<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OfertaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Suas Ofertas';
?>
<div class="oferta-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php foreach ($ofertasUsuario as $oferta) : ?>
        <div class="oferta-item">
            <div>
                <h2><?= $oferta->nome ?></h2>
                <p><?= $oferta->descricao ?></p>
                <?php if (is_array($oferta->imagem)) : ?>
                    <?php foreach ($oferta->imagem as $imagem) : ?>
                        <img src="<?= Yii::$app->urlManager->baseUrl ?>/uploads/ofertas/<?= $imagem['arquivo']->nome ?>" alt="Imagem da Oferta">
                    <?php endforeach; ?>
                <?php else : ?>
                    <img src="<?= Yii::$app->urlManager->baseUrl ?>/uploads/ofertas/<?= $oferta->imagem->arquivo->nome ?>" alt="Imagem da Oferta">
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>