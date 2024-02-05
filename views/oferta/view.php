<?php

use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Oferta $model */

$this->title = $model->id;

YiiAsset::register($this);
?>
<div class="oferta-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Alterar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Excluir', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tem certeza que deseja excluir a oferta?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'nome',
            'descricao:ntext',
            [ //exibir imagem
                'label' => 'Imagem',
                'format' => 'raw',
                'value' => function ($model) {
                    /**
                     * @var $model \app\models\Oferta
                     */
                    if (!$model->hasImagem()) {
                        return null;
                    }
                    $imagemHtml = "";
                    foreach ($model->imagem as $imagem) {
                        $imagemHtml .= Html::img($imagem->arquivo->AbsoluteUrl(), [
                            'alt' => 'Imagem da oferta',
                            'height' => '200',
                            'class' => 'oferta-view__imagem'
                        ]);
                    }
                    return $imagemHtml;
                }
            ]
        ],
    ]) ?>

</div>