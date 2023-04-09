<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Visit $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Visits', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="visit-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p <? Yii::$app->user->identity->is_admin ?: 'hidden' ?>>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'client_id',
            'staff_id',
			[
				'attribute' => 'visit_date',
				'format' => ['date', 'php:d-m-Y H:i']
			],
            'visit_sum',
        ],
    ]) ?>

</div>
