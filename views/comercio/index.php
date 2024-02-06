<?php

use yii\helpers\Html;

$this->title = 'Comércios';

?>

<div class="comercio-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <hr>

    <div class="filter">

    </div>

    <div class="categorias-comercios">
    <?php foreach ($categorias as $categoria) : ?>
        <h2><?= $categoria ?></h2>
        <ul>
            <?php foreach ($comerciosPorCategoria[$categoria] as $comercio) : ?>
                <li><?= $comercio->nomeComercio ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endforeach; ?>
</div>


</div>