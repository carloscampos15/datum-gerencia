<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PaisSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pais';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pais-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Pais', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nombre',
            'creado_por',
            'creado_el',
            'actualizado_por',
            //'actualizado_el',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
