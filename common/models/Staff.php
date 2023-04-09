<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string $email
 * @property int $is_staff
 * @property int $is_admin
 * @property int $is_manager
 * @property int $status
 * @property     $created_at
 * @property     $updated_at
 * @property string|null $verification_token
 * @property string $phone
 * @property int|null $discount
 */
class Staff extends User
{
	public $password;

	/**
	 * @return array
	 */
    public function rules(): array
	{
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'phone'], 'required'],
            [['is_staff', 'is_admin', 'is_manager', 'status', 'discount'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'verification_token', 'phone'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['phone'], 'unique', 'targetClass' => '\common\models\User', 'message' => 'Номер телефона уже используется.'],
            [['password_reset_token'], 'unique'],
            [['created_at', 'updated_at', 'password'], 'safe'],
        ];
    }

	/**
	 * @param $id
	 *
	 * @return mixed|null
	 */
	static function getNameClient($id) {
		$staff = Staff::findOne(['id' => $id]);
		return $staff->username ?: 'noname';
	}
}
