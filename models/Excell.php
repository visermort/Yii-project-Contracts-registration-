<?php

namespace app\models;

use Yii;
use codemix\yii2Excelexport;
use app\models\GoogleDrive;
use app\modules\contracts\models\Contracts;
use mikehaertl\phpTmpfile;


/**
 * Выгрузка списка контрактов в Excell
 */
class Excell
{
    /**
     * Выдача результата на закачку
     */
    public static function download()
    {
        $file = self::_makeExcell();
        $file->send('contracts.xlsx');
    }

    /**
     * Выдача результата в google drive
     */
    public static function toGoogleDrive()
    {
        //подключамемся к сервису.
        $service = new GoogleDrive();
        if ($service->hasToken()) {
            $file = self::_makeExcell();
            $file->saveAs('upload/contracts.xlsx');

            $service->saveFile('upload/contracts.xlsx');
        }
    }

    /**
    * получение документа Excell
    */
    private static function _makeExcell()
    {
        $file = \Yii::createObject([
            'class' => 'codemix\excelexport\ExcelFile',
            'writer' => '\PHPExcel_Writer_Excel2007', // Override default of `\PHPExcel_Writer_Excel2007`
            'sheets' => [
            'Contracts' => [
                'class' => 'codemix\excelexport\ActiveExcelSheet',
                'query' => Contracts::find(),
                'attributes' => [
                'id',
                'date',
                'name',
                'passport',
                'phone',
                'manufacturer',
                'model',
                'imei',
                'price',
                'sum',
                'percent',
                'user.username',

                ],
                'batchSize' => 1000000,
                ],
            ],
        ]);
        $phpExcell = $file->getWorkbook();
        foreach (range(0, 11) as $col) {
            $phpExcell
            ->getSheet(0)
            ->getColumnDimensionByColumn($col)
            ->setAutoSize(true);
        }
        return $file;
    }
}