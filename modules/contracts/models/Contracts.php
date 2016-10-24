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
            [['date', 'name', 'passport', 'manufacturer', 'model', 'imei', 'price', 'percent', 'sum'], 'required'],
            [['date'], 'safe'],
            [['price'], 'number'],
            [['sum'], 'integer'],
            [['name', 'passport'], 'string', 'max' => 100],
            [['phone', 'manufacturer', 'model', 'imei'], 'string', 'max' => 50],
            [['percent'], 'string', 'max' => 20],
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
            'percent' => 'Percent',
            'sum' => 'Summa',
            'user.display_name' => 'Sale Point',
           // 'sale_point' => 'Sale Point',
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
       if(parent::beforeSave($insert)) {
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

}
