<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

//class User extends \yii\base\Object implements \yii\web\IdentityInterface
class User extends ActiveRecord implements IdentityInterface
{
    // public $id;
    // public $username;
    // public $password;
    // public $authKey;
    // public $accessToken;
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    // private static $users = [
    //     '100' => [
    //         'id' => '100',
    //         'username' => 'admin',
    //         'password' => 'rucnqo',
    //         'authKey' => 'test100key',
    //         'accessToken' => '100-token',
    //     ],
        // '101' => [
        //     'id' => '101',
        //     'username' => 'demo',
        //     'password' => 'demo',
        //     'authKey' => 'test101key',
        //     'accessToken' => '101-token',
        // ],
//    ];
    public static function tableName()
    {
        return '{{%user}}';
    }

    // /**
    //  * @inheritdoc
    //  */
    // public static function findIdentity($id)
    // {
    //     return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    // }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
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
        // foreach (self::$users as $user) {
        //     if (strcasecmp($user['username'], $username) === 0) {
        //         Yii::$app->session->set('contracts_sailes_point', $salesPoint);
        //         //$_SESSION['contracts_sailes_point'] = $salesPoint;
        //         return new static($user);
        //     }
        // }

        // return null;
       $user = static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);

       if ($user) {
            Yii::$app->session->set('contracts_sailes_point', $user->username);
       }
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
        return Yii::$app->security->validatePassword($password, $this->password_hash);

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


}
