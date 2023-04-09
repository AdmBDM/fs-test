<?php

use common\models\Staff;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Staff';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="staff-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Staff', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
			[
				'class' => ActionColumn::class,
				'header' => 'Действия',
				'options' => ['width' => '100px'],
				'template' => '{view} {update}',
				'urlCreator' => function ($action, Staff $model, $key, $index, $column) {
					return Url::toRoute([$action, 'id' => $model->id]);
				}
			],

            'id',
            'username',
//            'auth_key',
//            'password_hash',
//            'password_reset_token',
            'email:email',
            'phone',
            'discount',
			[
				'attribute' => 'is_staff',
				'format' => ['boolean'],
			],
			[
				'attribute' => 'is_admin',
				'format' => ['boolean'],
			],
			[
				'attribute' => 'is_manager',
				'format' => ['boolean'],
			],
//            'status',
//            'created_at',
			[
				'attribute' => 'updated_at',
				'format' => ['date', 'php:d-m-Y H:i']
			],
//            'verification_token',
        ],
    ]); ?>


</div>
