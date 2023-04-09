<?php

	use common\models\User;
	use yii\helpers\ArrayHelper;
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Visit $model */
/** @var yii\widgets\ActiveForm $form */

	$items = User::find()->where('is_manager')->all();
	$managers = ArrayHelper::map($items, 'id', 'username');

	$items = User::find()->where('not is_staff')->all();
	$visitors = ArrayHelper::map($items, 'id', 'username');
?>

<div class="visit-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'client_id')->dropDownList($visitors, ['Выберите клиента']) ?>

    <?= $form->field($model, 'staff_id')->dropDownList($managers, ['Выберите менеджера']) ?>

    <?= $form->field($model, 'visit_date')->input('date') ?>

    <?= $form->field($model, 'visit_sum')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
