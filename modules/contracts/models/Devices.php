<?php

namespace app\modules\contracts\models;

use Yii;

/**
 * This is the model class for table "devices".
 *
 * @property integer $id
 * @property string $model
 * @property string $emai
 * @property string $manufacturer
 * @property decimal $price

 */
class Devices extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'devices';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['model', 'emai', 'price'], 'required'],
            [['model', 'emai', 'manufacturer'], 'string', 'max' => 50],
            [['price'], 'number', 'numberPattern' => '/^\s*[-+]?[0-9]*[.,]?[0-9]+([eE][-+]?[0-9]+)?\s*$/'],
            [['emai'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'model' => 'Модель',
            'emai' => 'IMEI',
            'manufacturer' => 'Производитель',
            'price' => 'Цена',
            'fullName' => 'Устройство',
        ];
    }

    /**
     * @inheritdoc
     * @return DevicesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DevicesQuery(get_called_class());
    }

    public function getFullName()
    {
        return $this->manufacturer.' '.$this->model.', IMEI '.$this->emai.', price '.$this->price;
    }
}
