<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Todolist */
/* @var $form yii\widgets\ActiveForm */

$this->registerCssFile('//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
$this->registerJs("
    $('#deadline').datepicker();
    $('#deadline').datepicker('option', 'dateFormat', 'yy-mm-dd');
");
?>

<h1 style="padding: 0 30px"><span class="glyphicon glyphicon-pencil"></span> Add new task</h1>

<div class="todolist-form col-md-6">

    <?php $form = ActiveForm::begin([
        'action' => ['create'],
        'id' => 'todolist-form'
    ]); ?>

    <div class="col-sm-8">
        <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'id' => 'task-title'])->hint('100 characters maximum') ?>
    </div>

    <div class="col-sm-4">
        <?= $form->field($model, 'deadline')->textInput(['id' => 'deadline'])->hint('Set last day of the task') ?>
    </div>

    <div class="col-sm-12">
        <?= $form->field($model, 'description')->textarea(['rows' => 6, 'id' => 'task-description'])->hint('Describe your task in details') ?>
    </div>

    <div class="form-group col-sm-12">
        <?= Html::Button('Create', ['class' => 'btn btn-success', 'id' => 'add-task-btn']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php $this->registerJs("
        $('#add-task-btn').on('click', function(e){
            e.preventDefault();
            $.post({
                url: $('#todolist-form').attr('action'),
                data: $('#todolist-form').serialize(),
                success: function(response){
                    $('#task-title').val('');
                    $('#deadline').val('');
                    $('#task-description').val('');
                    $('#todolist-table-container').empty().append(response);
                },
                error: function(response){}
            });
        });
    "); ?>

</div>

<div class="col-md-6">
    <h3>Some description:</h3>

    <p>To change status of task you need to click <span class="glyphicon glyphicon-ok"></span> symbol in the left side of the row. Completed tasks highlited by gray color, those which is in progress highlighted by blue color.</p>

    <p>Title is a link to page with task details.</p>

    <p>I use standart yii widget (grid view), but I customize it little. I disable sorting functionality in titles and add <span class="text-primary">addOrderBy()</span>method in active query in search model.</p>

    <p>So, data in table sorted by status <span class="text-danger">ascending</span> and by deadline date <span class="text-danger">descending</span>.</p>

    <p>In "add new task" section I use datepicker from JQuery UI to help fill "deadline" field as you suggest.</p>
</div>