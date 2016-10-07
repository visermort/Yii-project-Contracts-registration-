<?php

namespace app\modules\contracts\models;

use Yii;
use app\modules\contracts\models\Summa;

/**
 * This is the model class for table "contracts".
 *
 * @property integer $id
 * @property string $date
 * @property integer $client_id
 * @property integer $device_id
 * @property string $summa
 *
 * @property Devices $device
 * @property Clients $client
 */
class Contracts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'contracts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'client_id', 'device_id'], 'required'],
            [['date'], 'safe'],
            [['client_id', 'device_id'], 'integer'],
            [['summa'], 'number'],
            [['device_id'], 'exist', 'skipOnError' => true, 'targetClass' => Devices::className(), 'targetAttribute' => ['device_id' => 'id']],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => Clients::className(), 'targetAttribute' => ['client_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '№',
            'date' => 'Дата',
            'client_id' => 'Client ID',
            'device_id' => 'Device ID',
            'summa' => 'Сумма',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDevice()
    {
        return $this->hasOne(Devices::className(), ['id' => 'device_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Clients::className(), ['id' => 'client_id']);
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
            
            //получаем вычисляемую сумму контракта
            $this->summa = Summa::getSumma($this->device_id);

            //если она 0 то запись отменяется
            if ($this->summa == 0) {
                return false;
            }

            return true;
        } else {
            return false;
        }
    }

}
