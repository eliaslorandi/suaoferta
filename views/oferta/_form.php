<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Oferta $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="oferta-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descricao')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'arquivoImagem')->fileInput()?>

    <?php foreach($model->imagem as $imagem): ?>
        <?=  Html::img($imagem->arquivo->AbsoluteUrl(), [
            'alt' => 'Imagem da oferta',
            'height' => '200',
            'class' => 'project-view__imagem'
        ]); ?>
    <?php endforeach; ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
