<?php

use frontend\models\Vehiculos;
use kartik\grid\GridView;
use kartik\helpers\Html;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model frontend\models\MantenimientosSearch */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Otros Ingresos por Vehiculo';

?>
<?php Pjax::begin(['enablePushState' => false]); ?>
<div class="otros-ingresos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['otros-ingresos'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]);?>

    <div class="container-fluid col-sm-12">
        <div class="row">
            <div class="col-sm-6">
                <label>
                    <i class="fa fa-car" aria-hidden="true"></i> Vehiculo
                </label>
                <?= $form->field($model, 'vehiculo_id')->widget(Select2::classname(), [
                    'data' => !empty($model->vehiculo_id) ? [$model->vehiculo_id => Vehiculos::findOne($model->vehiculo_id)->placa] : [],
                    'pluginOptions' => [
                        'placeholder' => 'Seleccione un vehiculo',
                        'allowClear' => true,
                        'minimumInputLength' => 0,
                        'language' => [
                            'errorLoading' => new JsExpression("function () { return 'Esperando por resultados...'; }"),
                        ],
                        'ajax' => [
                            'url' => Yii::$app->urlManager->createUrl('vehiculos/vehiculos-list'),
                            'dataType' => 'json',
                            'data' => new JsExpression('function(params) { return {q:params.term}; }')
                        ],
                    ]
                ])->label(false)
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <?= Html::submitButton('<i class="fa fa-search" aria-hidden="true"></i>  Buscar', ['class' => 'btn btn-primary']) ?>
                <?= Html::resetButton('<i class="fa fa-refresh" aria-hidden="true"></i> Limpiar', ['class' => 'btn btn-outline-secondary']) ?>
            </div>
        </div>
        <div class="row" style="margin-top:40px;">
            <div class="col-sm-12">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    //'filterModel' => $searchModel,
                    'panel' => [
                        'type' => GridView::TYPE_PRIMARY,
                        'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-save-file"></i> Informe de Otros Ingresos</h3>',
                    ],
                    'responsive' => true,
                    'hover' => true,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        [
                            'attribute' => 'vehiculo_id',
                            'value' => function ($data) {
                                return $data->vehiculo->placa;
                            },
                            'format' => 'raw',
                        ],
                        'fecha',
                        [
                            'attribute' => 'valor_ingreso',
                            'value' => function ($data) {
                                return '$ '. number_format($data->valor_ingreso, 0, '', '.');
                            },
                            'format' => 'raw', 
                        ],
                        [
                            'attribute' => 'tipo_ingreso_id',
                            'value' => function ($data) {
                                return $data->tipoIngreso->nombre;
                            },
                            'format' => 'raw',
                        ],
                        [
                            'attribute' => 'cliente_id',
                            'value' => function ($data) {
                                return $data->cliente->nombre;
                            },
                            'format' => 'raw',
                        ],
                        'codigo',
                        'observacion',
                        [
                            'attribute' => 'id', 'visible' => false
                        ],
                    ],

                    'export' => [
                        'label' => 'Descargar',
                    ],

                    'exportConfig' => [
                        GridView::EXCEL => ['label' => 'Exportar a EXCEL',  'filename' => 'Otros Ingresos Vehiculo',],
                        GridView::CSV    => ['Exportar CSV'],

                    ]
                ]); ?>
            </div>
        </div>
    </div>


    <?php ActiveForm::end(); ?>

</div>
<?php Pjax::end(); ?>