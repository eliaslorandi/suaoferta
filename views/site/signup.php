<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
?>
<div class="site-signup">
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
            <?= $form->field($model, 'nomeComercio') ?>
            <?= $form->field($model, 'username') ?>
            <?= $form->field($model, 'email') ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            <!-- campo para selecionar opção de estabelecimento -->
            <?= $form->field($model, 'categoriaComercio')->dropDownList(
                [
                    'Mercado' =>        'Mercado',
                    'Cafeteria' =>      'Cafeteria',
                    'Restaurante' =>    'Restaurante',
                    'Açougue' =>        'Açougue',
                    'Barbearia' =>      'Barbearia',
                    'Cabelereiro(a)' => 'Cabelereiro(a)',
                    'Farmácia' =>       'Farmácia',
                    'Estética' =>       'Estética',
                ],
                ['prompt' => 'Selecione uma opção']
            ) ?>
            <div class="form-group">
                <?= Html::submitButton('Registrar', ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>