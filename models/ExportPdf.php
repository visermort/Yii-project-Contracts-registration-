<?php

namespace app\models;

//use Yii;
use kartik\mpdf\Pdf;

/**
 * Выгрузка в ПДФ
 */
class ExportPdf
{
    public static function export($data)
    {
        $pdf = new Pdf([
        // set to use core fonts only
        'mode' => 'Pdf::MODE_CORE',
            // A4 paper format
            'format' => Pdf::FORMAT_A4,
             // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $data,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => 'body {font-size:10px}',
             // set mPDF properties on the fly
            'options' => ['title' => 'Contract'],
             // call mPDF methods on the fly
            'methods' => [
                 
                'SetFooter'=>['Стр. {PAGENO} из {nb}'],
            ]
        ]);
    
        // return the pdf output as per the destination setting
        return $pdf->render();
    }
}