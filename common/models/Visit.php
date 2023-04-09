<?php

namespace common\models;

use Yii;
use yii\db\ActiveQuery as ActiveQueryAlias;

/**
 * This is the model class for table "visit".
 *
 * @property int $id
 * @property int $client_id
 * @property int $staff_id
 * @property int $visit_date
 * @property float $visit_sum
 */
class Visit extends \yii\db\ActiveRecord
{
	public $manager;
	public $visiter;

	/**
	 * @return string
	 */
    public static function tableName(): string
	{
        return 'visit';
    }

	/**
	 * @return array[]
	 */
    public function rules(): array
	{
        return [
            [['client_id', 'staff_id', 'visit_date'], 'required'],
            [['client_id', 'staff_id',], 'integer'],
            [['visit_date'], 'safe'],
            [['visit_sum'], 'number'],
        ];
    }

	/**
	 * @return string[]
	 */
    public function attributeLabels(): array
	{
        return [
            'id' => 'ID',
            'client_id' => 'Клиент',
            'staff_id' => 'Менеджер',
            'visit_date' => 'Дата',
            'visit_sum' => 'Сумма',
            'manager' => 'Менеджер',
            'visiter' => 'Клиент',
        ];
    }

	/**
	 * @return ActiveQueryAlias
	 */
	public function getManager(): ActiveQueryAlias
	{
		return $this->hasOne(User::class, ['id' => 'staff_id']);
	}

	/**
	 * @return ActiveQueryAlias
	 */
	public function getVisiter(): ActiveQueryAlias
	{
		return $this->hasOne(User::class, ['id' => 'client_id']);
	}
}
