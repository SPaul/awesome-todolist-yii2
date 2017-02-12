<?php

use yii\helpers\Html;
use yii\grid\GridView;

?>

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