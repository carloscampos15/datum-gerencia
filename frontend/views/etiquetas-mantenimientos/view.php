<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\EtiquetasMantenimientos */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Etiquetas Mantenimientos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="etiquetas-mantenimientos-view">

    <p>
        <?= Html::a('<i class="fa fa-edit" aria-hidden="true"></i> Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="fa fa-trash" aria-hidden="true"></i> Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Estás seguro que deseas eliminar este item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'nombre',
            'codigo',
            //'creado_por',
            //'creado_el',
            //'actualizado_por',
            //'actualizado_el',
        ],
    ]) ?>
    <?= Html::a( '<i class="fa fa-arrow-left" aria-hidden="true"></i> Volver', yii\helpers\Url::to([Yii::$app->controller->id.'/']),['class'=>'btn btn-default']);?>

</div>