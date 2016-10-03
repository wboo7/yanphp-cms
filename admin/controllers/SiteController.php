<?php

namespace admin\controllers;

use common\libs\Bridge;
use common\models\Banner;
use common\models\Config;
use common\models\Content;
use common\models\Photos;
use Yii;
use admin\controllers\BackendController;
use admin\models\LoginForm;
use yii\filters\VerbFilter;

use common\models\User;

/**
 * Site controller
 */
class SiteController extends BackendController
{


    public $enableCsrfValidation = false;
    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'minLength' => 4,
                'maxLength' => 4,
                'width' => 70,
                'height' => 30,
                'padding' => 2

                // 'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {

        return $this->render('index',[
            'soft_name' => '',
            'soft_version' => '1.0',
            'admin_role_name' => '',
            'admin' => '',
            'admin_role' => '',
            'site_tag'=>'',

        ]);
    }

    public function actionBody()
    {

        return $this->render('body');
    }

    public function actionLogin()
    {

        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if($post = Yii::$app->request->post())
        {
            $model->load(Yii::$app->request->post());

            if($model->login())
            {
                $user  = Yii::$app->user->identity;
                $user->logindate = time();
                $user->loginip = Yii::$app->request->userIP;
                $user->save(false);
                return $this->goBack();
            }
            else
            {
                return $this->renderPartial('login', [
                    'model' => $model
                ]);
            }

        }
        else
        {
            return $this->renderPartial('login', [
                'model' => $model
            ]);
        }

    }

    public function actionLogout()
    {

        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionGetRecycle()
    {
        $data = $this->recycle();
        return $this->jsonReturn($data);
    }
    public function actionDoRecycle($file)
    {
        $uploadPath = Bridge::getRootPath().'uploads/';
        if(is_file($uploadPath.$file))
        {
            unlink($uploadPath.$file);
            return $this->jsonReturn([]);
        }

    }
    protected function recycle()
    {
        //1.content thumb and photos
        $total = 0;
        $files=[];
        $rootPath = Bridge::getRootPath();

        $contentThumbs = Content::find()
            ->asArray()
            ->select('thumb')
            ->column();
        $contentPhotos = Photos::find()
            ->asArray()
            ->select('filepath')
            ->column();

        $contents = array_merge($contentThumbs,$contentPhotos);

        $contentFiles = $this->getFiles($rootPath.'uploads/content');
        if($contentFiles)
        {
            foreach($contentFiles as $v)
            {
                if(!in_array($v,$contents))
                {
                    $total++;
                    $files[] ='content/'.$v;
                }
            }
        }

        //2.banner
        $banners = Banner::find()
            ->select('filepath')
            ->asArray()
            ->column();
        $bannerFiles =$this->getFiles($rootPath.'uploads/banner');
        if($bannerFiles)
        {
            foreach($bannerFiles as $v)
            {
                if(!in_array($v,$banners))
                {
                    $total++;
                    $files[] ='banner/'.$v;
                }
            }
        }

        //3.config
        $configs = Config::find()
            ->where(['type'=>Config::TYPE_IMAGE])
            ->select('value')
            ->asArray()
            ->column();
        $configFiles =$this->getFiles($rootPath.'uploads/config');
        if($configFiles)
        {
            foreach($configFiles as $v)
            {
                if(!in_array($v,$configs))
                {
                    $total++;
                    $files[] ='config/'.$v;
                }
            }
        }


        return [
            'total'=>$total,
            'files'=>$files
        ];
    }
    protected function getFiles($dirName)
    {
        $result = [];
        if(!is_dir($dirName))
            return false;
        if ( $handle = opendir($dirName))
        {
            while (false !== ($item = readdir($handle)))
            {
                if ($item != "." && $item != "..")
                {
                    $result[] = $item;
                }
            }
            closedir( $handle );

        }
        return $result;
    }



}
