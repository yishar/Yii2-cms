<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\NoticiaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Noticias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="noticia-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Noticia', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'titulo',
            'seo_slug',
            [
                //'contentOptions' => ['class' => 'text-wrap'] ,

                'attribute' => 'detalle',
                'value' => function($data) {
                  return Html::tag('span', substr(strip_tags($data->detalle), 0, 50) . '....', [ 'data-toggle' => 'tooltip', 'title' => $data->detalle, 'style' => 'cursor:help;']);
              },  
                       'format' => 'raw',
                
            ],
            'categoria_id',
            // 'estado',
            // 'created_by',
            // 'created_at',
            // 'updated_by',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
