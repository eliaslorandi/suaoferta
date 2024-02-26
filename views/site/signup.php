<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Crie Sua Conta';
?>
<div class="site-signup">
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
            <?= $form->field($model, 'nomeComercio')->label('Nome do Comércio (Como irá aparecer para os clientes)') ?>
            <?= $form->field($model, 'username')->label('Username (Para efetetuar o login)') ?>
            <?= $form->field($model, 'email') ?>
            <?= $form->field($model, 'password')->label('Senha')->passwordInput() ?>
            <!-- campo para selecionar opção de estabelecimento -->
            <?= $form->field($model, 'categoriaComercio')->label('Categoria do Comércio')->dropDownList(
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