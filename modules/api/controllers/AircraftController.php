<?php

namespace app\modules\api\controllers;

use app\modules\api\models\Aircraft;

class AircraftController extends \yii\web\Controller
{

    const TYPE_EMERGENCY = 1;
    const TYPE_VIP = 2;
    const TYPE_PASSENGER = 3;
    const TYPE_CARGO = 4;

    const SIZE_SMALL = 1;
    const SIZE_LARGE = 2;

    public $enableCsrfValidation = false;

    public function actionIndex()
    {

        \Yii::$app->response->format = \Yii\web\Response::FORMAT_JSON;

        $aircraft = Aircraft::find()->all();

        return [
            'status' => 200,
            'detail' => $aircraft
        ];
    }

    public function actionEnqueue()
    {

        \Yii::$app->response->format = \Yii\web\Response::FORMAT_JSON;

        $aircraft = new Aircraft();
        $aircraft->scenario = Aircraft::SCENARIO_CREATE;
        $aircraft->attributes = \Yii::$app->request->post()['Aircraft'];

        if ($aircraft->validate()) {
            $aircraft->save();

            return [
                'status' => 200,
                'detail' => 'Aircraft created successfully.'
            ];
        } else {
            return [
                'status' => 400,
                'detail' => $aircraft->getErrors()
            ];
        }
    }

    public function actionDequeue()
    {

        \Yii::$app->response->format = \Yii\web\Response::FORMAT_JSON;

        $aircrafts = Aircraft::find()->where(['state' => 0])->all();

        $emergency = Aircraft::find()
            ->where(['type_id' => self::TYPE_EMERGENCY, 'state' => 0])
            ->orderBy('id DESC')
            ->all();

        $vip = Aircraft::find()
            ->where(['type_id' => self::TYPE_VIP, 'state' => 0])
            ->orderBy('id DESC')
            ->all();

        $passenger = Aircraft::find()
            ->where(['type_id' => self::TYPE_PASSENGER, 'state' => 0])
            ->orderBy('id DESC')
            ->all();

        $cargo = Aircraft::find()
            ->where(['type_id' => self::TYPE_CARGO, 'state' => 0])
            ->orderBy('id DESC')
            ->all();

        $priority = true;
        $message = '';

        foreach ($aircrafts as $aircraft) {

            switch ($aircraft->type_id) {

                case self::TYPE_EMERGENCY:

                    $validate = $this->validate($aircraft, $emergency);

                    $priority = $validate['priority'];
                    $message = $validate['message'];

                    break;

                case self::TYPE_VIP:

                    if (count($emergency) > 0) {
                        $priority = false;
                        $message = 'Aircraft with emergency in queue';
                    } else {
                        $validate = $this->validate($aircraft, $vip);

                        $priority = $validate['priority'];
                        $message = $validate['message'];
                    }

                    break;

                case self::TYPE_PASSENGER:

                    if (count($emergency) > 0) {
                        $priority = false;
                        $message = 'Aircraft with emergency in queue';
                    } else if (count($vip) > 0) {
                        $priority = false;
                        $message = 'VIP aircraft in queue';
                    } else {
                        $validate = $this->validate($aircraft, $passenger);

                        $priority = $validate['priority'];
                        $message = $validate['message'];
                    }

                    break;

                case self::TYPE_CARGO:

                    if (count($emergency) > 0) {
                        $priority = false;
                        $message = 'Aircraft with emergency in queue';
                    } else if (count($vip) > 0) {
                        $priority = false;
                        $message = 'VIP aircraft in queue';
                    } else if (count($passenger) > 0) {
                        $priority = false;
                        $message = 'Queued passenger aircraft';
                    } else {
                        $validate = $this->validate($aircraft, $cargo);

                        $priority = $validate['priority'];
                        $message = $validate['message'];
                    }

                    break;
            }

            if ($priority === true) {
                $aircraft->state = 1;
                if ($aircraft->save()) {
                    $message = 'Aircraft properly removed from tail. <br>' 
                        . 'ID: ' . $aircraft->id 
                        . ' TYPE: ' . $aircraft->type->name
                        . ' SIZE: ' . $aircraft->size->name;
                    return [
                        'status' => $priority ? 200 : 400,
                        'detail' => $message
                    ];
                    break;
                } else {
                    $message = 'an error occurred while removing the aircraft from the queue';
                    return [
                        'status' => $priority ? 200 : 400,
                        'detail' => $message
                    ];
                    break;
                }
            }
        }

        return [
            'status' => 400,
            'detail' => 'Record not found'
        ];
    }

    private function validate($aircraft, $aircrafts)
    {
        $priority = true;
        $message = '';

        foreach ($aircrafts as $airc) {
            if ($aircraft->size_id == self::SIZE_LARGE) {
                if ($airc->id < $aircraft->id && $airc->size_id == self::SIZE_LARGE) {
                    $priority = false;
                    $message = "Aircraft with higher priority and long queue load";
                    break;
                }
            } else {
                if ($airc->id < $aircraft->id && in_array($airc->size_id, [self::SIZE_LARGE, self::SIZE_SMALL])) {
                    $priority = false;
                    $message = "Highest priority aircraft in queue";
                    break;
                }
            }
        }

        return [
            'priority' => $priority,
            'message' => $message
        ];
    }
}
