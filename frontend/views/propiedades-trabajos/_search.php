<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PropiedadesTrabajosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="propiedades-trabajos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tipo_vehiculo_id') ?>

    <?= $form->field($model, 'trabajo_id') ?>

    <?= $form->field($model, 'duracion') ?>

    <?= $form->field($model, 'costo_mano_obra') ?>

    <?php // echo $form->field($model, 'cantidad_trabajo') ?>

    <?php // echo $form->field($model, 'repuesto_id') ?>

    <?php // echo $form->field($model, 'cantidad_repuesto') ?>

    <?php // echo $form->field($model, 'creado_por') ?>

    <?php // echo $form->field($model, 'creado_el') ?>

    <?php // echo $form->field($model, 'actualizado_por') ?>

    <?php // echo $form->field($model, 'actualizado_el') ?>

    <?php // echo $form->field($model, 'empresa_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
