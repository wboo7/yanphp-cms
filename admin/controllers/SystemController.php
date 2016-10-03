<?php
namespace admin\controllers;

use admin\models\PasswordForm;
use admin\models\SettingForm;
use common\libs\Bridge;
use common\models\Banner;
use common\models\UploadForm;
use Yii;
use admin\controllers\BackendController;
use common\models\Config;
use yii\db\Query;
use common\helpers\File;
use yii\helpers\Html;



class SystemController extends BackendController
{

    public $layout = 'main';
    public $enableCsrfValidation = false;

    //.密码修改
    public function actionPassword()
    {
        $model = new PasswordForm();
        if($post = Yii::$app->request->post())
        {
            $model->load($post);
            if($model->validate())
            {
                $admin = Yii::$app->user->identity;

                $admin->password = $model->password;
                if($admin->save())
                {
                    return $this->renderSuccess('密码修改成功！');
                }
                else
                {
                    return $this->renderError($model);
                }

            }
            else
            {
                return $this->renderError($model);
            }
        }
        return $this->render('password',['model'=>$model]);
    }

    //.系统设置
    public function actionSetting()
    {
        $model = new SettingForm();
        $language = $model->getLanguage();
        $model->language = $language;

        if($post = Yii::$app->request->post())
        {
            $model->load($post);
            $model->save();
            return $this->render('setting',['model'=>$model]);
        }
        return $this->render('setting',['model'=>$model]);
    }




}
