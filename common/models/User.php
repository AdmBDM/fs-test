<?php

namespace common\models;

use Yii;
use yii\base\Exception;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $verification_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;
	const FORMAT_DATE = 'Y-m-d H:i:s';


	/**
	 * @return string
	 */
    public static function tableName(): string
	{
        return '{{%user}}';
    }

	/**
	 * @return string[]
	 */
    public function behaviors(): array
	{
        return [
            TimestampBehavior::class,
        ];
    }

	/**
	 * @return array[]
	 */
    public function rules(): array
	{
        return [
            ['status', 'default', 'value' => self::STATUS_INACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_INACTIVE, self::STATUS_DELETED]],
        ];
    }

	/**
	 * @return string[]
	 */
	public function attributeLabels(): array
	{
		return [
			'id' => 'ID',
			'username' => 'Имя',
			'password_hash' => 'hash',
			'password_reset_token' => 'token',
			'verification_token' => 'контрольный',
			'email' => 'E-mail',
			'is_staff' => 'Сотрудник',
			'is_admin' => 'Администратор',
			'is_manager' => 'Менеджер',
			'status' => 'Статус',
			'created_at' => 'Создана',
			'updated_at' => 'Изменено',
			'auth_key' => 'Ключ',
			'password' => 'Пароль',
			'phone' => 'Мобильный',
			'discount' => 'Discount',
		];
	}

	/**
	 * @param $id
	 *
	 * @return User|IdentityInterface|null
	 */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

	/**
	 * @param $token
	 * @param $type
	 *
	 * @return IdentityInterface|null
	 * @throws NotSupportedException
	 */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by email
     *
     * @param string $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds user by verification email token
     *
     * @param string $token verify email token
     * @return static|null
     */
    public static function findByVerificationToken($token) {
        return static::findOne([
            'verification_token' => $token,
//            'status' => self::STATUS_INACTIVE
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token): bool
	{
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

	/**
	 * @return array|int|mixed|string|null
	 */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

	/**
	 * @return string
	 */
    public function getAuthKey(): string
	{
        return $this->auth_key;
    }

	/**
	 * @param $authKey
	 *
	 * @return bool
	 */
    public function validateAuthKey($authKey): bool
	{
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password): bool
	{
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

	/**
	 * Generates password hash from password and sets it to the model
	 *
	 * @param string $password
	 *
	 * @throws Exception
	 */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Generates new token for email verification
     */
    public function generateEmailVerificationToken()
    {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
}
