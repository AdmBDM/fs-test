<?php

use common\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],
			[
				'class' => ActionColumn::className(),
				'urlCreator' => function ($action, User $model, $key, $index, $column) {
					return Url::toRoute([$action, 'id' => $model->id]);
				}
			],

//            'id',
            'username',
//            'auth_key',
//            'password_hash',
//            'password_reset_token',
            'email:email',
            'is_staff',
            'is_admin',
            'is_manager',
            //'status',
            //'created_at',
            //'updated_at',
            //'verification_token',
        ],
    ]); ?>


</div>
