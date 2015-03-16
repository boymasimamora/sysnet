<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Button;
use yii\bootstrap\Modal;
use kartik\detail\DetailView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\RequestStatusSearch $searchModel
 */

$this->title = Yii::t('app', 'Request Statuses');
$this->params['breadcrumbs'][] = $this->title;
?>

<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript">
    $( document ).ready(function() {
        // $(".field-requeststatus-followed_up_by_id").hide();
    });

    function tesfungsi(obj, stat, id)
    {
        $.ajax({    
                type:"POST",
                url:"<?php echo Yii::$app->urlManager->createUrl('/request-status/updatestatus?status="+stat+"&id="+id+"'); ?>",
                data:"status="+stat+"&id="+id,
                //contentType: "application/json; charset=utf-8",
                dataType:"json",
                success:function(data){
                    var hasil = data.result[0].stat;
                    alert(hasil);
                    //hoteleAlert('Data has been stored!');
                    /*setTimeout( function() {
                        jQuery('#loading_mask').hide();
                        window.location.href = "<?php echo Yii::$app->urlManager->createUrl('/ar/arMaster/index'); ?>";
                    }, 100 );*/
                }
            });

        if(stat == 0)
        {
            $(obj).removeClass("btn btn-warning btn-sm");
            $(obj).addClass("btn btn-success btn-sm");
            $(obj).html('Done');
        }
        else
        {
            $(obj).removeClass("btn btn-success btn-sm");
            $(obj).addClass("btn btn-warning btn-sm");
            $(obj).html('Pending');
        }
    }

    function gorba(obj)
    {
        alert(JSON.stringify(obj));
    }
</script>


<div class="request-status-index">
    <div class="page-header">
            <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php /* echo Html::a(Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Request Status',
]), ['create'], ['class' => 'btn btn-success'])*/  ?>
    </p>

    <?php Pjax::begin(); echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'follow_up_date',
            //'followed_up_by_id',
            [
                'format'=>'raw',
                'attribute'=>'followed_up_by_id',
                'value'=>function($data){
                    return $data->followedUpBy->email;
                },
            ],
            [
                'label'=>'Customer',
                'format'=>'raw',
                //'attribute'=>'followed_up_by_id',
                'value'=>function($data){
                    $connection = Yii::$app->db;
                    $techadmin = $connection->createCommand('SELECT name FROM customer WHERE id=(select customer_id from sales_request where request_status_id = '.$data->id.')')->queryAll();
                    return $techadmin[0]['name'];
                },
            ],
            //'technician:ntext',
            [
                'attribute'=>'technician',
                'value'=>function($data){
                    return strlen($data->technician) >= 20? substr($data->technician, 0, 19).'....' : $data->technician;
                },
            ],
            //'scheduled_date',
            [
                'attribute'=>'scheduled_date',
                'value'=>function($data){
                    return date('d/M/Y', strtotime($data->scheduled_date));
                },
            ],
//            'notes:ntext', 
//            'status', 

            /*[
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                'update' => function ($url, $model) {
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', Yii::$app->urlManager->createUrl(['request-status/view','id' => $model->id,'edit'=>'t']), [
                                                    'title' => Yii::t('yii', 'Edit'),
                                                  ]);}

                ],
            ],*/
            [
                //'label'=>'tombol',
                //'attribute'=>'',
                'format' => 'raw',
                'value'=>function ($data) {
                    if($data->status == 0)
                    {
                        //return '<a type="button" id="btn_status'.$data->id.'" onclick="tesfungsi()" class="btn btn-warning btn-sm" href='.Yii::$app->homeUrl."/request-status/create?req=".$data->id.'>Pending</a>';
                        return '<a type="button" id="btn_status'.$data->id.'" href="'.Yii::$app->urlManager->createUrl('/request-status/update?id=').$data->id.'" class="btn btn-default btn-sm">Reschedule</a>';
                    }
                    else
                    {
                        return ' ';
                        //return '<a type="button" id="btn_status'.$data->id.'" onclick="tesfungsi()" class="btn btn-success btn-sm" href='.Yii::$app->homeUrl."/request-status/create?req=".$data->id.'>Done</a>';
                        //return '<a type="button" id="btn_status'.$data->id.'" onclick="tesfungsi(this, '.$data->status.', '.$data->id.')" class="btn btn-success btn-sm">Done</a>';
                    }
                },  
            ],
            [
                'class' => '\kartik\grid\BooleanColumn',
                'attribute'=>'status',
                'trueLabel' => 'Done',
                //'trueIcon'=> '',
                'falseLabel' => 'Pending'
            ],
            [
                //'label'=>'tombol',
                //'attribute'=>'',
                'format' => 'raw',
                'value'=>function ($data) {
                    if($data->status == 0)
                    {
                        //return '<a type="button" id="btn_status'.$data->id.'" onclick="tesfungsi()" class="btn btn-warning btn-sm" href='.Yii::$app->homeUrl."/request-status/create?req=".$data->id.'>Pending</a>';
                        return '<a type="button" id="btn_status'.$data->id.'" onclick="tesfungsi(this, '.$data->status.', '.$data->id.')" class="btn btn-warning btn-sm">Pending</a>';
                    }
                    else
                    {
                        //return '<a type="button" id="btn_status'.$data->id.'" onclick="tesfungsi()" class="btn btn-success btn-sm" href='.Yii::$app->homeUrl."/request-status/create?req=".$data->id.'>Done</a>';
                        return '<a type="button" id="btn_status'.$data->id.'" onclick="tesfungsi(this, '.$data->status.', '.$data->id.')" class="btn btn-success btn-sm">Done</a>';
                    }
                },  
            ],
            
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
