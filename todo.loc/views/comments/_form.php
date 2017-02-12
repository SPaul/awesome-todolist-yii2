<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Comments */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comments-form">

    <?php $form = ActiveForm::begin([
    	'action' => ['comments/create'],
    	'id' => 'comment-form',
    ]); ?>

    <?= $form->field($model, 'task_id')->hiddenInput(['maxlength' => true, 'value' => $id])->label(false) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'required' => 1, 'id' => 'comment-name']) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6, 'required' => 1, 'id' => 'comment-content']) ?>

    <div class="form-group">
        <?= Html::submitButton('Create', ['class' => 'btn btn-success', 'id' => 'add-comment-btn']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php $this->registerJs("
	$('#add-comment-btn').on('click', function(e){
		e.preventDefault();
		$.post({
			url: $('#comment-form').attr('action'),
			data: $('#comment-form').serialize(),
			success: function(response){
				$('#comment-name').val('');
				$('#comment-content').val('');
				$('#comments-list-bar').empty().append(response);
			},
			error: function(response){}
		});
	});
"); ?>