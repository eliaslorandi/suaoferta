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

    <?php foreach ($imagensOferta as $imagem) : ?>
        <img src="<?= Yii::getAlias('@web/uploads/ofertas/' . $imagem->arquivo->absoluteUrl()) ?>" alt="Imagem Oferta">
    <?php endforeach; ?>

</div>