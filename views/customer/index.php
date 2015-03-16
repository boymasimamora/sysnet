<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\CustomerSearch $searchModel
 */

$this->title = Yii::t('app', 'Customers');
$this->params['breadcrumbs'][] = $this->title;

$connection = Yii::$app->db;
$user_id = Yii::$app->user->id;
$sales = $connection->createCommand('SELECT case WHEN count(DISTINCT item_name) = 1 THEN "1" ELSE "0" end as bool FROM auth_assignment WHERE user_id = '.$user_id.' AND item_name LIKE("%ales")')->queryAll();
$sales = $sales[0]['bool'];
?>
<div class="customer-index">
    <div class="page-header">
            <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php /* echo Html::a(Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Customer',
]), ['create'], ['class' => 'btn btn-success'])*/  ?>
    </p>

    <?php Pjax::begin(); echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            'address:ntext',
            [
                //'label'=>'tombol',
                //'attribute'=>'',
                'format' => 'raw',
                'value'=>function ($data) {
                    //return '<a type="button" id="btn_status'.$data->id.'" onclick="tesfungsi()" class="btn btn-warning btn-sm" href='.Yii::$app->homeUrl."/request-status/create?req=".$data->id.'>Pending</a>';
                    return '<a type="button" id="btn_status'.$data->id.'" href="'.Yii::$app->urlManager->createUrl('/customer/update?id=').$data->id.'" class="btn btn-default btn-sm">Update</a>';
                },  
            ],
            $sales == 1 ? ['visible'=>false]:[
                //'label'=>'tombol',
                //'attribute'=>'',
                'format' => 'raw',
                'value'=>function ($data) {
                    //return '<a type="button" id="btn_status'.$data->id.'" onclick="tesfungsi()" class="btn btn-warning btn-sm" href='.Yii::$app->homeUrl."/request-status/create?req=".$data->id.'>Pending</a>';
                    return '<a type="button" id="btn_status'.$data->id.'" href="'.Yii::$app->urlManager->createUrl('/customer/delete?id=').$data->id.'" class="btn btn-default btn-sm" data-method="post">Delete</a>';
                },  
            ],
            /*[
                //'label'=>'tombol',
                //'attribute'=>'',
                'format' => 'raw',
                'value'=>function ($data) {
                    //return '<a type="button" id="btn_status'.$data->id.'" onclick="tesfungsi()" class="btn btn-warning btn-sm" href='.Yii::$app->homeUrl."/request-status/create?req=".$data->id.'>Pending</a>';
                    return '<a type="button" id="btn_status'.$data->id.'" href="'.Yii::$app->urlManager->createUrl('/customer/update?id=').$data->id.'" class="btn btn-default btn-sm">Delete</a>';
                },  
            ],*/
            /*[
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                'update' => function ($url, $model) {
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', Yii::$app->urlManager->createUrl(['customer/view','id' => $model->id,'edit'=>'t']), [
                                                    'title' => Yii::t('yii', 'Edit'),
                                                  ]);}

                ],
            ],*/
        ],
        'responsive'=>true,
        'hover'=>true,
        'condensed'=>true,
        'floatHeader'=>true,




        'panel' => [
            'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-th-list"></i> '.Html::encode($this->title).' </h3>',
            'type'=>'info',
            'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Add', ['create'], ['class' => 'btn btn-success']),                                                                                                                                                          'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset List', ['index'], ['class' => 'btn btn-info']),
            'showFooter'=>false
        ],
    ]); Pjax::end(); ?>

</div>
