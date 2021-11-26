<?php
namespace app\controllers;

use yii\helpers\Json;
use yii\web\Controller;
use yii\web\Response;

class ErrorController extends Controller
{
    public function actionIndex()
    {
        $request = @Json::decode(\Yii::$app->request->rawBody);
        $e = \Yii::$app->getErrorHandler()->exception;

        $res = [
            'id' => 0,
            'jsonrpc' => '2.0',
            'error' => [
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
                'data' => null
            ]
        ];

        if (!empty($request['id'])) {
            $res['id'] = $request['id'];
        }

        $this->response->format = Response::FORMAT_JSON;

        return $res;
    }
}
