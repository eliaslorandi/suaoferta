<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Oferta $model */
/** @var yii\widgets\ActiveForm $form */

$this->registerJsFile(
    '@web/js/ofertaForm.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);

?>

<div class="oferta-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descricao')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'arquivoImagem')->fileInput() ?>

    <?php foreach ($model->imagem as $imagem): ?>
        <div id="oferta-form__imagem-container-<?= $imagem->id ?>" class="oferta-form__imagem-container">
            <?= Html::img($imagem->arquivo->AbsoluteUrl(), [
                'alt' => 'Imagem da oferta',
                'height' => '200',
                'class' => 'oferta-form__imagem'
            ]); ?>

            <?= Html::button('Excluir', [
                'class' => 'btn btn-danger btn-excluir-imagem',
                'data-imagem-oferta-id' => $imagem->id
            ]) ?>
            <div id="oferta-form__imagem-error-message-<?= $imagem->id ?>" class="text-danger"></div>
        </div>
    <?php endforeach; ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>