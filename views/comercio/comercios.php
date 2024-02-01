<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;

$this->title = 'Comércios';

?>

<div class="comercios-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="filter">
       
    </div>

    <div class="comercios-list">
        <h2>Lista de Comércios</h2>
        <ul>
            <?php foreach ($comercios as $comercio) : ?>
                <li><?= $comercio->nomeComercio ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>