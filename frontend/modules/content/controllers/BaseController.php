<?php
namespace frontend\modules\content\controllers;

use Yii;

use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\helpers\Url;

use yii\web\Controller;
use yii\db\Query;

/**
 * 内容管理系统 基础控制器
 */
class BaseController extends Controller
{

    public function init()
    {
        parent::init();

    }



    /**
     * AJAX提示
     * @param string $state 提示类型 success , fail
     * @param string $msg 提示消息
     * @param string $referer 跳转地址
     */
    public function ajaxReturn($state = 'success', $message = '',$data='', $referer = '')
    {
        $data = array(
            'state'   => $state,
            'message' => $message,
            'data'=>$data,
            'referer' => $referer,
            'timestamp'=>time()
        );
        echo json_encode($data);
        exit;
    }

    protected function jsonReturn($arr)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $arr;
    }



}
