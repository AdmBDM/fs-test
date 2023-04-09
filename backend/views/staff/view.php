<?php

use yii\helpers\Html;
	use yii\web\YiiAsset;
	use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Staff $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Staff', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="staff-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
<!--        --><?php //= Html::a('Delete', ['delete', 'id' => $model->id], [
//            'class' => 'btn btn-danger',
//            'data' => [
//                'confirm' => 'Are you sure you want to delete this item?',
//                'method' => 'post',
//            ],
//        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
//            'auth_key',
//            'password_hash',
//            'password_reset_token',
            'email:email',
            'phone',
            'discount',
            'is_staff:boolean',
            'is_admin:boolean',
            'is_manager:boolean',
//            'status',
//            'created_at',
			[
				'attribute' => 'updated_at',
				'format' => ['date', 'php:d-m-Y H:i']
			],
//            'verification_token',
        ],
    ]) ?>

</div>
