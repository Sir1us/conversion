<?php

namespace backend\controllers;
use linslin\yii2\curl;
use Yii;

class ConversionController extends \yii\web\Controller
{

    public function actionIndex()
    {

        $codeCountryValue = Yii::$app->request->post('valcode');
        $PickedCodeValue = Yii::$app->request->post('select_code');
        $date = Yii::$app->request->post('conversion_date');
        $postValueSum = Yii::$app->request->post('uahsum');
        $dateformat = str_replace("-", "", $date);
        $postValueFromLink = array();
        $postChooseValue = array();
        $patternSum = '(^\d+(?:[.]\d{1,100}|$)$)';
        if (isset($dateformat) && !empty($dateformat) && date('Ymd', strtotime($dateformat)) && preg_match($patternSum, $postValueSum) &&
            $postValueSum && $dateformat > 0 && $postValueSum && $codeCountryValue !== null && !empty($codeCountryValue)) {

            if ($PickedCodeValue !== null && !empty($PickedCodeValue)) {
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, 'http://bank.gov.ua/NBUStatService/v1/statdirectory/exchange?valcode=' . $PickedCodeValue . '&date=' . $dateformat . '&json');
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                $out = curl_exec($curl);
                $postChooseValue[] = json_decode($out, true);
            }

            foreach ($codeCountryValue as $code3words) {

                    $curl = curl_init();
                    curl_setopt($curl, CURLOPT_URL, 'http://bank.gov.ua/NBUStatService/v1/statdirectory/exchange?valcode='.$code3words.'&date='. $dateformat .'&json');
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    $out = curl_exec($curl);
                    $postValueFromLink[] = json_decode($out, true);
            }



            return $this->render('index', [
                'postValueFromLink' => $postValueFromLink,
                'postChooseValue' => $postChooseValue,
            ]);
        }

        return $this->render('index');
    }

}
