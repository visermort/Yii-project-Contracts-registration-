<?php

namespace app\modules\contracts\models;

use Yii;
use app\models\User;

/**
 * This is the model class for table "{{%contracts}}".
 *
 * @property integer $id
 * @property string $date
 * @property string $name
 * @property string $passport
 * @property string $phone
 * @property string $manufacturer
 * @property string $model
 * @property string $imei
 * @property string $price
 * @property string $percent
 * @property integer $sum
 * @property string $sale_point
 */
class Contracts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%contracts}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'name', 'passport', 'manufacturer', 'model', 'imei', 'price', 'tariff', 'sum'], 'required'],
            [['date'], 'safe'],
            [['price', 'tariff'], 'number'],
            [['sum'], 'integer'],
            [['name', 'passport'], 'string', 'max' => 100],
            [['phone', 'manufacturer', 'model', 'imei'], 'string', 'max' => 50],
           // [['percent'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'name' => 'Nume Prenume',
            'passport' => 'IDNP',
            'phone' => 'Telefon mobil',
            'manufacturer' => 'Marca',
            'model' => 'Model',
            'imei' => 'IMEI',
            'price' => 'Costul aparatului',
            'percent' => 'Tariff',
            'tariff' => 'Tariff',


            'sum' => 'Summa',
            'user.username' => 'Sale Point',
            'salePoint' => 'Sale Point',
           
        ];
    }

    /**
     * @inheritdoc
     * @return ContractsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ContractsQuery(get_called_class());
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->id_user = Yii::$app->user->identity->id;
            }
            return true;
        }
        return false;
    }


    public function getUser()
    {
         return $this->hasOne(User::className(), ['id' => 'id_user']);
    }
    public function getsalePoint()
    {
        return $this->user->username;
    }

    public function getpercent()
    {
        $language = ($_COOKIE['contractLang'] ? $_COOKIE['contractLang'] : 'ro');
        return $this->percentDic[$language][(int)$this->tariff];
    }


    private $percentDic = [
        'ro' => [
            '0' => '',
            '10' => '10 (zece)',
            '12' => '12 (douăsprezece)',
            '14' => '14 (paisprezece)',
        ],
        'ru' => [
            '0' => '',
            '10' => '10 (десять)',
            '12' => '12 (двенадцать)',
            '14' => '14 (четырнадцать)',
        ],
    ];



}
