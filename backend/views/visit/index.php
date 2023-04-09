<?php

use common\models\Staff;
use common\models\Visit;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var common\models\VisitSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Visits';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="visit-index">

    <h1><?= Html::encode($this->title) ?></h1>

	<form class="client-form">

	</form>

    <p>
        <?= Html::a('Create Visit', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

	<?php Pjax::begin(); ?>
	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<?= GridView::widget([
        'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			[
				'class' => ActionColumn::class,
				'header' => 'Действия',
				'options' => ['width' => '100px'],
				'template' => '{view} {update}',
				'urlCreator' => function ($action, Visit $model, $key, $index, $column) {
					return Url::toRoute([$action, 'id' => $model->id]);
				}
			],

//            'id',
			[
				'label' => 'Клиент',
				'value' => function ($model) {
					return Staff::getNameClient($model->client_id);
				},
			],
			[
				'label' => 'Менеджер',
				'value' => function ($model) {
					return Staff::getNameClient($model->staff_id);
				},
			],
			[
				'attribute' => 'visit_date',
				'format' => ['date', 'php:d-m-Y H:i']
			],
            'visit_sum',
        ],
    ]); ?>

	<?php Pjax::end(); ?>


</div>
