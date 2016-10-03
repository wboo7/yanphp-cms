<?php
namespace admin\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\helpers\Url;


class BackendController extends Controller
{

    public $enableCsrfValidation = false;
    public $layout = 'main';


    public function init()
    {

        parent::init();



    }

    public function beforeAction($action)
    {
        if (!parent::beforeAction($action)) {
            return false;
        }
        if (in_array($action->id, ['login', 'captcha'])) {
            return parent::beforeAction($action);
        }

        if (\Yii::$app->user->isGuest) {
            $url = Url::to(['/site/login']);
            exit('<script>top.location.href="' . $url . '"</script>');
        }


        if (!in_array($action->id, ['logout', 'error', 'welcome'])) {

        }
        return parent::beforeAction($action);
    }



    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }


    public function actionLogout()
    {

        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * AJAX提示
     * @param string $state 提示类型 success , fail
     * @param string $msg 提示消息
     * @param string $referer 跳转地址
     */
    public function ajaxReturn($state = 'success', $message = '', $data = '', $referer = '')
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $data = array(
            'state' => $state,
            'message' => $message,
            'data' => $data,
            'referer' => $referer,
            'timestamp' => time()
        );
        echo json_encode($data);
        exit;
    }
    protected function jsonReturn($arr)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $arr;
    }

    public function renderError($model,$msg=false)
    {

        if($msg)
        {
            $message = $model;
        }
        else
        {
            $err = $model->getErrors();
            if ($err) {
                foreach ($err as $v) {
                    $message = $v[0];
                    break;
                }
            }
        }

        return $this->render('@app/views/error', ['data' => $message, 'back' => Yii::$app->request->referrer]);
    }

    /*-- 直接输出成功页面 --*/
    public function renderSuccess($msg, $url = '')
    {

        if (!$url)
            $url = Yii::$app->request->referrer;
        return $this->render('@app/views/success', ['data' => $msg, 'url' => $url]);
    }

    public function getUploadRoot()
    {
       $proId = Yii::$app->programe->id;
        if($proId)
        {
            return Yii::$app->programe->path;
        }
        else
        {
            return Yii::getAlias('@webroot/');
        }
    }

    //获取缩略图路劲
    public function getThumbUrl($path,$default='statics/admin/images/thumb.png')
    {
        $proId = Yii::$app->programe->id;

        if($path)
        {
            if($proId)
            {
                if(strncmp($path,'data',4) == 0)
                    return Yii::getAlias('@web/'.$path);
                else
                    return Yii::$app->programe->url.$path;

            }

            else
            {
                return Yii::getAlias('@web/').$path;
            }

        }
        else
        {
            return Yii::getAlias('@web/'.$default);
        }

    }




}
