<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\CuentasContables */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cuentas-contables-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'codigo')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
    <?= Html::a('<i class="fa fa-arrow-left" aria-hidden="true"></i> Volver', Url::to([Yii::$app->controller->id . '/']), ['class' => 'btn btn-default']); ?>

        <?= Html::submitButton('<i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar', ['class' => 'btn btn-success pull-right']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
