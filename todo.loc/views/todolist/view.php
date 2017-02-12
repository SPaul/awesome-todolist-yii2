<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Todolist */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Todolist', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="todolist-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p id="task-status-bar">

        <?= (bool) $model->status ? '<span class="label label-danger">This task is completed!</span>' : Html::button('<span class="glyphicon glyphicon-ok"></span> Finish this task', ['data-id' => $model->id, 'class' => 'btn btn-primary changestatus-btn']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            'description:ntext',
            'deadline',
        ],
    ]) ?>

</div>

<div class="col-md-6">
    <h1><span class="glyphicon glyphicon-pencil"></span> Write a comment</h1>
    <?= $this->render('..\comments\_form', ['model' => $commentsModel, 'id' => $model->id]);?>
</div>

<div class="col-md-6">
    <h1><span class="glyphicon glyphicon-list"></span> Comments list</h1>
    <div id="comments-list-bar">
        <?= $this->render('..\comments\list', ['model' => $model->comments]);?>
    </div>
</div>

<?php if(!$model->status){
    $this->registerJs("
        changeTaskStatusHandler = function(data){
            $('#task-status-bar').empty().append(' <span class=\"label label-danger\">This task is completed!</span> ');
        }

        url = '".Url::to(['changestatus'])."';
    ");
    $this->registerJsFile(
        '@web/js/change-status-btn-click.js',
        ['depends' => [\yii\web\JqueryAsset::className()]]
    );
}?>