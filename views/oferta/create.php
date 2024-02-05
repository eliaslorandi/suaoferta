<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Oferta $model */

$this->title = 'Nova Oferta';

?>
<div class="oferta-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <hr>
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
