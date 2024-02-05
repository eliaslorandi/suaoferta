<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\ImagemOferta;

$this->title = 'Todas as Ofertas';
//$this->params['breadcrumbs'][] = $this->title;

?>

<div class="site-comercios">
    <h1><?= Html::encode($this->title) ?></h1>
</div>
<div class="oferta-index">

    <?php foreach ($ofertas as $oferta) : ?>
        <div class="todas-ofertas">
            <h2><?= $oferta->nome ?></h2>
            <p><?= $oferta->descricao ?></p>
            <?php foreach ($oferta->imagem as $imagem) : ?>
                <img src="<?= Yii::$app->urlManager->baseUrl ?>/uploads/ofertas/<?= $imagem->arquivo->nome ?>" alt="Imagem da Oferta" style="max-width: 500px; max-height: 500px;">
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
</div>