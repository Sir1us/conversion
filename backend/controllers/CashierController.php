<?php

namespace backend\controllers;
use backend\models\Cashier;
use backend\models\CashierAgreements;
use Yii;
use SimpleXMLElement;

class CashierController extends \yii\web\Controller
{
    public function beforeAction($action)
    {
        // ...set `$this->enableCsrfValidation` here based on some conditions...
        // call parent method that will check CSRF if such property is true.
        if ($action->id === 'index') {

            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        if(Yii::$app->request->post('table') == 'cashierdata') {

            $AllCashier = Cashier::find()->asArray()->all();

            $jsonCashierInfo = [];
            foreach ($AllCashier as $valueCashier) {
                $jsonValuesForCashier = new \stdClass();
                $jsonValuesForCashier->cashier_id = $valueCashier['id'];
                $jsonValuesForCashier->cashier_name = $valueCashier['name'];
                $jsonValuesForCashier->cashier_second_name = $valueCashier['second_name'];
                $jsonValuesForCashier->agreement_id = $valueCashier['agreement_id'];

                $AllCashierAgreements = CashierAgreements::find()->where(['=', 'id', $valueCashier['agreement_id']])->orderBy('id')->limit(1)->asArray()->all();

                if (empty($AllCashierAgreements)) {
                    $jsonValuesForCashier->agreement_id = "Пусто";
                    $jsonCashierInfo[] = $jsonValuesForCashier;
                } else {
                    foreach ($AllCashierAgreements as $valueAgreements) {
                        $jsonValuesForCashier->agreement_number = $valueAgreements['number'];
                        $jsonValuesForCashier->agreement_date_from = $valueAgreements['date_from'];
                        $jsonValuesForCashier->agreement_date_to = $valueAgreements['date_to'];
                        $jsonCashierInfo[] = $jsonValuesForCashier;
                    }
                }
            }

            if (!Yii::$app->request->post('format'))  {
                $UnloadingCashier = json_encode($jsonCashierInfo);

                echo $UnloadingCashier;
            } elseif (Yii::$app->request->post('format') == 'xml') {

                $UnloadingCashier = json_encode($jsonCashierInfo);
                $decode = json_decode($UnloadingCashier, true);

                function array_to_xml($decode, $xml_data)
                {
                    foreach ($decode as $key => $value) {
                        if (is_array($value)) {
                            if (is_numeric($key)) {
                                $key = 'cashier' . $key; //dealing with <0/>..<n/> issues
                            }
                            $subnode = $xml_data->addChild($key);
                            array_to_xml($value, $subnode);
                        } else {
                            $xml_data->addChild("$key", htmlspecialchars("$value"));
                        }
                    }
                }

                $xml_data = new SimpleXMLElement('<?xml version="1.0"?><xml></xml>');

                array_to_xml($decode, $xml_data);

                $xmlCashier = $xml_data->asXML();

                return $xmlCashier;


            } elseif (Yii::$app->request->post('format') == 'array') {

                $UnloadingCashier = json_encode($jsonCashierInfo);
                $decode = json_decode($UnloadingCashier, true);

                 print_r($decode);
            }

        } else {

            echo '[{"error": "Невалидный параметр table"}]';
        }

    }

}
