<?php

use frontend\models\Proveedores;
use frontend\models\TiposCombustibles;
use kartik\date\DatePicker;
use kartik\grid\GridView;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model frontend\models\CombustiblesSearch */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Detalle Combustible por Proveedor';

?>
<?php Pjax::begin(['enablePushState' => false]); ?>
<div class="combustibles-search">

    <?php $form = ActiveForm::begin([
        'action' => ['combustible-detalle-proveedor'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <div class="container-fluid col-sm-12">
        <div class="row">
            <div class="col-sm-4">
                <label>
                    <i class="fa fa-calendar" aria-hidden="true"></i> Fecha del checklist
                </label>
                <?= DatePicker::widget([
                    'model' => $model,
                    'attribute' => 'fecha_1',
                    'attribute2' => 'fecha_2',
                    'options' => ['placeholder' => 'Fecha Inicial'],
                    'options2' => ['placeholder' => 'Fecha Final'],
                    'type' => DatePicker::TYPE_RANGE,
                    'form' => $form,
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'autoclose' => true,
                    ]
                ]); ?>
            </div>
            <div class="col-sm-4">
                <label>
                    <i class="fa fa-tachometer" aria-hidden="true"></i> Tipo de combustible
                </label>
                <?= $form->field($model, 'tipo_combustible_id')->widget(Select2::classname(), [
                    'data' => !empty($model->tipo_combustible_id) ? [$model->tipo_combustible_id => TiposCombustibles::findOne($model->tipo_combustible_id)->nombre] : [],
                    'pluginOptions' => [
                        'placeholder' => 'Seleccione un Tipo de Combustible',
                        'allowClear' => true,
                        'minimumInputLength' => 0,
                        'language' => [
                            'errorLoading' => new JsExpression("function () { return 'Esperando por resultados...'; }"),
                        ],
                        'ajax' => [
                            'url' => Yii::$app->urlManager->createUrl('tipos-combustibles/tipos-combustibles-list'),
                            'dataType' => 'json',
                            'data' => new JsExpression('function(params) { return {q:params.term}; }')
                        ],
                    ]
                ])->label(false)
                ?>
            </div>
            <div class="col-sm-4">
                <label>
                    <i class="fa fa-industry" aria-hidden="true"></i> Proveedor
                </label>
                <?= $form->field($model, 'proveedor_id')->widget(Select2::classname(), [
                    'data' => !empty($model->proveedor_id) ? [$model->proveedor_id => Proveedores::findOne($model->proveedor_id)->nombre] : [],
                    'pluginOptions' => [
                        'placeholder' => 'Seleccione un proveedor',
                        'allowClear' => true,
                        'minimumInputLength' => 0,
                        'language' => [
                            'errorLoading' => new JsExpression("function () { return 'Esperando por resultados...'; }"),
                        ],
                        'ajax' => [
                            'url' => Yii::$app->urlManager->createUrl('proveedores/proveedores-list'),
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
                    // 'filterModel' => $searchModel,
                    'panel' => [
                        'type' => GridView::TYPE_PRIMARY,
                        'heading' => '<h3 class="panel-title"><i class="glyphicon glyphicon-search"></i>  ' . $this->title . '</h3>',
                    ],
                    'responsive' => true,
                    'hover' => true,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'fecha',
                        [
                            'label' => 'Vehículo',
                            'attribute' => 'vehiculo_id',
                            'value' => 'vehiculo.placa'
                        ],                       
                        'medicion_actual',
                        [
                            'attribute' => 'total_cost',
                            'label' => 'Costo Total',
                            'value' => function ($e) {
                                return '$ ' . number_format($e->total_cost, 0, '', '.');
                            },
                        ],
                        'cantidad_combustible',
                        [
                            'attribute' => 'costo_por_galon',
                            'label' => 'Costo por Galón',
                            'value' => function ($e) {
                                return '$ ' . number_format($e->costo_por_galon, 0, '', '.');
                            },
                        ],
                        [
                            'attribute' => 'medicion_actual',
                            'label' => 'Km x Volum',
                            'value' => function ($e) {
                                return 0;
                            },
                        ],
                        [
                            'label' => 'Conductor',
                            'attribute' => 'usuario_id',
                            'value' => 'usuario.name'
                        ],
                        ['attribute'=>'observacion',
                        'headerOptions' => ['style' => 'width:10%']
                    ],
                        'numero_tiquete',
                        [
                            'attribute' => 'id', 'visible' => false
                        ],
                    ],
                    'export' => [
                        'label' => 'Descargar',
                    ],

                    'exportConfig' => [
                        GridView::EXCEL => ['label' => 'Exportar a EXCEL',  'filename' => 'Consulta Combustible Proveedor',],
                        GridView::CSV    => ['Exportar CSV'],

                    ]
                ]); ?>
            </div>
        </div>


    </div>



    <?php ActiveForm::end(); ?>

</div>
<?php Pjax::end(); ?>