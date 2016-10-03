<?php
namespace admin\controllers;

use common\libs\Bridge;
use common\models\Banner;
use common\models\UploadForm;
use Yii;
use admin\controllers\BackendController;
use common\models\Config;
use yii\db\Query;
use common\helpers\File;
use yii\helpers\Html;
use yii\web\UploadedFile;


class ConfigController extends BackendController
{

    public $layout = 'main';
    public $enableCsrfValidation = false;

    public function actionSite()
    {
        $query = new Query();
        if($postData = Yii::$app->request->post() || $_FILES)
        {
            if(is_uploaded_file($_FILES['logo']['tmp_name'])){
                $upfile=$_FILES["logo"];
                $item = explode('.',$upfile['name']);
                $tmp_name=$upfile["tmp_name"];//上传文件的临时存放路径
                $logo_name = time().".".end($item);
                $path = $this->getProgramePath().'logo/';
                if(!is_dir($path))
                    File::dir_create($path);
                move_uploaded_file($tmp_name,$path.$logo_name);
            }
            $config = Yii::$app->request->post();
            if(isset($logo_name))
            {
                $config['site_logo'] = $this->getProgramePath().'logo/'.$logo_name;
            }

            if(!empty($config))
            {
                foreach($config as $id=>$value)
                {
                    $model = Config::findOne(['id'=>$id]);

                    if($model)
                    {
                        $model->value = $value;

                    }
                    else
                    {
                        $model = new Config();
                        $model->id = $id;
                        $model->value = $value;
                    }
                    $model->save();

                }
            }

            return $this->renderSuccess(Yii::t('app','Update Success'));

        }
        else
        {



            return $this->render('site');
        }
    }
    public function actionIndex()
    {

        if($post = Yii::$app->request->post())
        {
            foreach($post as $id=>$value)
            {

                $model = Config::findOne($id);
                if($model)
                {
                    if($model->type == Config::TYPE_IMAGE)
                    {

                        $uploadModel = new UploadForm();
                        $uploadModel->setScenario('image');
                        $uploadModel->file = UploadedFile::getInstanceByName($model->id);
                        if($uploadModel->file)
                        {
                            if($uploadModel->validate())
                            {
                                $extention = $uploadModel->file->getExtension();
                                $rootpath = Bridge::getRootPath();
                                $filename = uniqid().'.'.$extention;
                                if($uploadModel->file->saveAs($rootpath.'uploads/config/'.$filename))
                                {
                                    $model->value = $filename;
                                }
                            }
                            else
                            {
                                return $this->renderError($uploadModel);
                            }
                        }

                    }
                    else
                    {
                        $model->value = $value;
                    }

                    $model->save(false);
                    Config::deleteCache($model->id);
                }

            }
            return $this->renderSuccess(Yii::t('app','Save Success'));
        }
        return $this->render('index');
    }


    public function actionCreate()
    {
        if($post = Yii::$app->request->post())
        {
            $model = new Config();
            $model->load($post);

            if($model->save())
            {
                return $this->jsonReturn([
                    'title'=>Yii::t('app','Create Config'),
                    'content'=>Yii::t('app','Create Config Success , Please Edit The Config !'),
                    'refresh'=>'true'

                ]);
            }
            else
            {
                return $this->jsonReturn([
                    'title'=>Yii::t('app','Create Config'),
                    'content'=>implode(',',array_values($model->getFirstErrors())),
                    'footer'=>Html::button(Yii::t('app','Close'),['class'=>'btn btn-default','data-dismiss'=>'modal'])

                ]);
            }
        }
        return $this->jsonReturn([
            'title'=>Yii::t('app','Create Config'),
            'content'=>$this->renderPartial('_form'),
            'footer'=>Html::submitButton(Yii::t('app','Commit'),['class'=>'btn btn-default']).Html::button(Yii::t('app','Close'),['class'=>'btn','data-dismiss'=>'modal'])

        ]);
    }



    public function actionDelete($id)
    {
        if(in_array($id,['logo','site_title','site_keywords','site_description']))
        {
            return $this->jsonReturn([
                'title'=>Yii::t('app','Tip'),
                'content'=>Yii::t('app','Can Not Delete The Default Config'),
                'footer'=>Html::button(Yii::t('app','Close'),['class'=>'btn btn-default','data-dismiss'=>'modal'])

            ]);
        }
        if($one = Config::findOne($id))
        {
            $one->delete();
            Config::deleteCache($one->id);
            return $this->jsonReturn([
                'title'=>Yii::t('app','Tip'),
                'content'=>Yii::t('app','Delete Success'),
                'refresh'=>'true'

            ]);

        }

    }


}
