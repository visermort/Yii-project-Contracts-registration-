<?php

namespace app\modules\contracts\models;

use Yii;
use app\modules\contracts\models\Devices;

/**
 * This is the model class for table "clients".
 *
 * @property integer $id
 * @property string $name
 * @property string $birth
 * @property string $passport
 */
class Summa
{
	public static function getSumma($id)
	{
		$device = Devices::find()->where(['id' => $id])->one();

		$price =  $device->price;

		if ($price < 2401) {
			$summa = 0;
		} elseif ($price < 7001){
			 $summa = $price * 0.14;
		} elseif ($price < 15001) {
			$summa = $price * 0.12;
		} else {
			$summa = $price * 0.1;
		}

		return $summa;

	}

}