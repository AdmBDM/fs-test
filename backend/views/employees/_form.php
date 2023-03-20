<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
	use function PHPUnit\Framework\isNull;

	/** @var yii\web\View $this */
/** @var common\models\User $model */
/** @var yii\widgets\ActiveForm $form */
/** @var boolean $newFlag */

	$newFlag = isset($newFlag) ?: false;
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'username')->textInput() ?>
    <?php if ($newFlag) {
		echo $form->field($model, 'auth_key')->textInput();} ?>
<!--    --><?php //= $form->field($model, 'password_hash')->textInput() ?>
    <?= $form->field($model, 'email')->textInput() ?>
    <?= $form->field($model, 'is_staff')->checkbox() ?>
    <?= $form->field($model, 'is_admin')->checkbox() ?>
    <?= $form->field($model, 'is_manager')->checkbox() ?>
    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
