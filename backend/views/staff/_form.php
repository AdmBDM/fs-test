<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Staff $model */
/** @var yii\widgets\ActiveForm $form */

?>

<div class="staff-form">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_staff')->checkbox() ?>

    <?= $form->field($model, 'is_admin')->checkbox() ?>

    <?= $form->field($model, 'is_manager')->checkbox() ?>

    <?= $form->field($model, 'status')->hiddenInput(['maxlength' => true])->label(false) ?>

    <?= $form->field($model, 'phone')
			->textInput([
				'placeholder' => 'Телефон в формате (XXX) XXX-XX-XX',
				'id' => 'phone',
			]) ?>

    <?= $form->field($model, 'discount')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
