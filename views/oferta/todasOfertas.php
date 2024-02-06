<?php

use yii\helpers\Html;

$this->title = 'Todas as Ofertas';

?>

<div class="site-comercios">
    <h1><?= Html::encode($this->title) ?></h1>
    <hr>
</div>
<div class="oferta-index">

    <?php foreach ($ofertas as $oferta) : ?>
        <div class="todas-ofertas">
            <h2><strong> <?= $oferta->user->nomeComercio ?></strong></h2>
            <h4><?= $oferta->nome ?></h4>
            <?php foreach ($oferta->imagem as $imagem) : ?>
                <div class="imagem-oferta">
                    <img src="<?= Yii::$app->urlManager->baseUrl ?>/uploads/ofertas/<?= $imagem->arquivo->nome ?>" alt="Imagem da Oferta" style="max-width: 500px; max-height: 500px;">
                </div>
            <?php endforeach; ?>
            <p><?= $oferta->descricao ?></p>
        </div>
    <?php endforeach; ?>
</div>