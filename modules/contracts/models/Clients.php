<?php

namespace app\modules\contracts\models;

use Yii;

/**
 * This is the model class for table "clients".
 *
 * @property integer $id
 * @property string $name
 * @property string $birth
 * @property string $passport
 */
class Clients extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'clients';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['phone', 'name', 'passport'], 'safe'],
            [['name', 'passport'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 32],
            [['name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'N.P.',
            'passport' => 'IDNP',
            'fullName' => 'Client',
            'phone' => 'Telefon mobil',
        ];
    }

    /**
     * @inheritdoc
     * @return ClientsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ClientsQuery(get_called_class());
    }

    public function getFullName()
    {
        return $this->name.', passport '.$this->passport;
    }


}
