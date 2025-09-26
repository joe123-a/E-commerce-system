<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    public $password;
    // public $confirm_password; // Commented out temporarily

    public static function tableName()
    {
        return 'user';
    }

    public function rules()
    {
        return [
            [['username', 'email', 'password'], 'required', 'on' => 'register'], // Removed confirm_password
            [['username', 'password'], 'required', 'on' => 'login'],
            [['username'], 'string', 'max' => 50],
            [['email'], 'email'],
            [['email'], 'string', 'max' => 255],
            [['username', 'email'], 'unique'],
            [['password'], 'string', 'min' => 6], // Add minimum password length
            [['password_hash'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['role'], 'string', 'max' => 20],
            [['role'], 'default', 'value' => 'customer'],
            [['status'], 'integer'],
            [['status'], 'default', 'value' => 1],
            [['created_at'], 'safe'],
            // [['confirm_password'], 'compare', 'compareAttribute' => 'password', 'on' => 'register'], // Commented out
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'confirm_password' => 'Confirm Password',
            'password_hash' => 'Password Hash',
            'auth_key' => 'Auth Key',
            'role' => 'Role',
            'status' => 'Status',
            'created_at' => 'Created At',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            // Only hash password if it's not empty and this is during registration
            if (!empty($this->password) && $this->scenario === 'register') {
                $this->password_hash = Yii::$app->security->generatePasswordHash($this->password);
            }
            
            // Generate auth_key for new records
            if ($insert || empty($this->auth_key)) {
                $this->auth_key = Yii::$app->security->generateRandomString();
            }
            
            // Set created_at for new records
            if ($insert) {
                $this->created_at = date('Y-m-d H:i:s');
            }
            
            return true;
        }
        return false;
    }

    // IdentityInterface implementation
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => 1]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null; // Not used in this system
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    // Find user by username for both admin and customer
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => 1]);
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }
}