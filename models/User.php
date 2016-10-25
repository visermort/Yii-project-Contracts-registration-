<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

//class User extends \yii\base\Object implements \yii\web\IdentityInterface
class User extends ActiveRecord implements IdentityInterface
{

    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    public $Statusbool;
    public $newpassword;
   

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Saile Point',
            'display_name' => 'Display Name',
            'status' => 'Status',
            'StatusText' => 'Active',
            'Statusbool' => 'Active',
            'newpassword' => 'New password',
        ];
    }


    public static function tableName()
    {
        return '{{%user}}';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            [['username', 'display_name'], 'string', 'max' => 255],
            [['newpassword'], 'string', 'max' => 32],
            [['Statusbool'], 'boolean'],
            [['username', 'display_name', ], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {

       $user = static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);

       return $user;

    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
       // return $this->password === $password;
       $result =  Yii::$app->security->validatePassword($password, $this->password_hash);
       //$this->isAdmin = $this->username == 'admin';
       return $result;
    }
    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
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

    public function getStatusText()
    {
        if ($this->status == self::STATUS_ACTIVE) {
            return 'Yes';
        } else return 'No';
    }
    public function getStatusbool()
    {
        if ($this->status == self::STATUS_ACTIVE) {
            return 1;
        } else return 0;
    }


    public function beforeSave($insert)
    {
       if(parent::beforeSave($insert)) {
           if ($insert) {
                $this->password_hash = Yii::$app->security->generatePasswordHash('12345');
                $this->auth_key = Yii::$app->security->generateRandomString();
           }
           
           if ($this->Statusbool == '1') {
                $this->status = self::STATUS_ACTIVE;
           } elseif ($this->Statusbool == '0') {
                $this->status = self::STATUS_DELETED;
           }
           
           if (!$insert && $this->newpassword) {
                $this->password_hash = Yii::$app->security->generatePasswordHash($this->newpassword);
                $this->auth_key = Yii::$app->security->generateRandomString();
           }

           return true;
       }
       return false;
    }






}
