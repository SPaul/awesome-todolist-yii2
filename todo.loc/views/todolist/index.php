<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TodolistSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Todolist';
$this->params['breadcrumbs'][] = $this->title;
$this->registerJsFile(
    'https://code.jquery.com/ui/1.12.1/jquery-ui.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJs("
    /**
     * following code update table content
     */
    changeTaskStatusHandler = function(data){
        $.get({
            url: '".Url::to(['refreshtable'])."',
            success: function(response){
                $('#todolist-table-container').empty().append(response);
            },
        });
    }
    /**
     * change task status url
     */
    url = '".Url::to(['changestatus'])."';
");
$this->registerJsFile(
    '@web/js/change-status-btn-click.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
?>
<div class="todolist-index col-md-12">

    <h1><span class="glyphicon glyphicon-list"></span> <?= Html::encode($this->title) ?></h1>
    <div id="todolist-table-container">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => [
         'class' => 'table table-striped table-hover table-condensed'
        ],
        'columns' => [
            [
                'class' => 'yii\grid\DataColumn',
                'label' => 'Status',
                'value' => function ($data) {
                    $inProgress = Html::tag('span', '', ['class' => 'glyphicon glyphicon-ok text-primary']);
                    $completed = Html::tag('span', '', ['class' => 'glyphicon glyphicon-ok text-muted']);
                    $sign = Html::tag('p', $inProgress, ['data-id' => $data->id, 'class' => 'changestatus-btn', 'style' => 'cursor: pointer']);

                    return (bool) $data->status ? $completed : $sign;
                },
                'format' => 'raw',
                'options' => [
                    'width' => '50px',
                ],
            ],
            [
                'class' => 'yii\grid\DataColumn',
                'label' => 'Title',
                'value' => function ($data) {
                    return Html::a($data->title, ['view', 'id' => $data->id]);
                },
                'format' => 'raw',
            ],
            [
                'class' => 'yii\grid\DataColumn',
                'label' => 'description',
                'value' => function ($data) {
                    $n = 20;
                    $text = (strlen($data->description) > $n) ? substr($data->description, 0, $n).'...' : $data->description; 
                    return Html::tag('p', $text);
                },
                'format' => 'raw',
            ],
            [
                'class' => 'yii\grid\DataColumn',
                'label' => 'deadline',
                'value' => function ($data) {
                    return $data->deadline;
                },
            ],
        ],
    ]); ?>
    </div>
</div>

<?= $this->render('_form', [
    'model' => $model,
]) ?>