<?php
namespace admin\controllers;

use common\models\Collect;
use common\models\Model;
use common\models\Photos;
use Yii;

use common\libs\Bridge;
use common\models\CategoryContent;
use common\models\Content;
use common\models\Page;
use common\libs\Tree;
use common\libs\Yanphp;
use common\models\Attachment;
use common\models\Position;
use common\models\PositionCategory;
use yii\helpers\Json;
use yii\web\UploadedFile;
use common\helpers\File;
use yii\helpers\Html;
use common\helpers\Func;



class ContentController extends BackendController
{

    public $layout = 'main';
    public function actionQuickSearch($keyword,$ctype)
    {
        switch($ctype)
        {
            case '1':
                $lists = CategoryContent::find()
                    ->where(['like','catname',$keyword])
                    ->andWhere(['ispage'=>0])
                    ->select(['id','catname'])
                    ->asArray()
                    ->all();
                if($lists)
                {
                    foreach($lists as $k=>$v)
                    {
                        $lists[$k]['url'] = '?r=content/index&catid='.$v['id'];
                        $lists[$k]['name'] = Func::strcut($v['catname'],40);
                    }
                    return $this->jsonReturn(['state'=>0,'data'=>$lists]);
                }
                else
                {
                    return $this->jsonReturn(['state'=>1]);
                }

                break;
            case '2':
                $lists = Content::find()
                    ->where(['like','title',$keyword])
                    ->select(['id','catid','title'])
                    ->asArray()
                    ->all();
                if($lists)
                {
                    foreach($lists as $k=>$v)
                    {
                        $lists[$k]['url'] = '?r=content/create&catid='.$v['catid'].'&id='.$v['id'];
                        $lists[$k]['name'] = Func::strcut($v['title'],40);
                    }
                    return $this->jsonReturn(['state'=>0,'data'=>$lists]);
                }
                else
                {
                    return $this->jsonReturn(['state'=>1]);
                }
                break;
            case '3':
                $lists = CategoryContent::find()
                    ->where(['like','catname',$keyword])
                    ->andWhere(['ispage'=>1])
                    ->select(['id','catname'])
                    ->asArray()
                    ->all();
                if($lists)
                {
                    foreach($lists as $k=>$v)
                    {
                        $lists[$k]['url'] = '?r=content/index&catid='.$v['id'];
                        $lists[$k]['name'] = Func::strcut($v['catname'],40);
                    }
                    return $this->jsonReturn(['state'=>0,'data'=>$lists]);
                }
                else
                {
                    return $this->jsonReturn(['state'=>1]);
                }
                break;
        }
    }
    /*
     * 内容列表
     * 如果是单页，就显示单页编辑
     * 单页其实是一个栏目
     * */
    public function actionIndex($catid=0)
    {

        if($catid)
        {
            $category = CategoryContent::findOne($catid);
            if($postData = Yii::$app->request->post())
            {
                //更新单页
                if($category->model->type == Model::TYPE_PAGE)
                {
                    $category->load($postData);

                    $category->save();
                    CategoryContent::clearCache();
                    return $this->renderSuccess(Yii::t('app','Update Success'));

                }
            }
            else
            {
                if($category->model->type == Model::TYPE_PAGE)
                    return $this->render('page',['model'=>$category]);

                $result = Content::search($catid);
                return $this->render('lists',[
                    'listData' => $result['lists'],
                    'pages' => $result['pages'],
                    'count' => $result['count'],
                    'category' => $category,
                ]);
            }




        }
        return $this->render('lists');
    }

    /*
     * @添加内容
     * */
    public function actionCreate($catid)
    {

        $catModel = CategoryContent::findOne($catid);
        $modelModel = $catModel->model;

        if($id = Yii::$app->request->get('id'))
            $model = Content::findOne($id);
        else
            $model = new Content();
        $model->setScenario($modelModel->tablename);

        $model->catid = $catid;

        if($postData = yii::$app->request->post())
        {
            if($model->load($postData))
            {

                $model->status = Content::STATUS_OK;
                $model->file = UploadedFile::getInstance($model,'file');

                if($model->file)
                {

                    if($model->validate('file'))
                    {
                        $uploadRoot = Bridge::getRootPath();
                        $savePath = 'uploads/content/';
                        $saveName = md5(uniqid().rand(1,111111)).'.'.$model->file->getExtension();
                        $file = $uploadRoot.$savePath.$saveName;

                        if(!$model->file->saveAs($file))
                            return $this->renderError($model);

                        //压缩图片
                        $image = Yii::$app->image->load($file);
                        $image->resize(300,NULL)->save($file);
                        $model->thumb = $saveName;
                    }
                    else
                    {
                        return $this->renderError($model);
                    }

                }

                if($model->save())
                {

                    $model->filePhoto = UploadedFile::getInstance($model,'filePhoto');

                    if($model->filePhoto)
                    {
                        if(!$model->validate('filePhoto'))
                            return $this->renderError($model);

                        $uploadRoot = Bridge::getRootPath();
                        $savePath = 'uploads/content/';
                        $saveName = md5(uniqid().rand(1,111111)).'.'.$model->filePhoto->getExtension();
                        $file = $uploadRoot.$savePath.$saveName;

                        if($model->filePhoto->saveAs($file))
                        {
                            //压缩图片
                            $image = Yii::$app->image->load($file);
                            $image->resize(300,NULL)->save($file);

                            $pModel = new Photos();
                            $pModel->name = '';
                            $pModel->contentid = $model->id;
                            $pModel->filepath = $saveName;
                            $pModel->save(false);
                        }

                    }

                    if(isset($postData['position']) && $postData['position'])
                    {
                        Position::deleteAll(['contentid'=>$model->id,'catid'=>$catid]);
                        foreach($postData['position'] as $v)
                        {
                            $posModel = new Position();
                            $posModel->contentid = $model->id;
                            $posModel->catid = $catid;
                            $posModel->pid = $v;
                            $posModel->status = 1;
                            $posModel->save(false);
                        }
                    }
                    else
                    {
                        Position::deleteAll(['contentid'=>$model->id,'catid'=>$catid]);
                    }
                    return $this->redirect(['content/create','catid'=>$catid,'id'=>$model->id]);
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
        else
        {

            $positionCategtorys = PositionCategory::find()->asArray()->all();
            $positions = [];
            if(isset($id) && $id && $catid)
            {
                $positions = Position::find()
                    ->asArray()
                    ->select('pid')
                    ->where(['contentid'=>$id,'catid'=>$catid])
                    ->column();

            }


            return $this->render('_form',[
                'model' => $model,
                'catModel'=>$catModel,
                'modelModel'=>$modelModel,
                'positionCategorys'=>$positionCategtorys,
                'positions'=>$positions
            ]);
        }
    }

    public function actionDeletePhoto($id)
    {
        $model = Photos::findOne($id);
        $model->delete();
        return $this->redirect(Yii::$app->request->getReferrer());
    }

    public function actionEditPhoto($id)
    {
        $title = '编辑图片标题';
        $model = Photos::findOne($id);
        $model->setScenario('photoName');

        if($post = Yii::$app->request->post())
        {
            $model->load($post);
            if($model->save())
            {
                return $this->jsonReturn([
                    'title'=>$title,
                    'content'=>Yii::t('app','Edit Success')
                ]);
            }
            else
            {
                return $this->jsonReturn([
                    'title'=>$title,
                    'content'=>Yii::t('app','Update Fail')
                ]);

            }
        }
        return $this->jsonReturn([
            'title'=>$title,
            'content'=>$this->renderPartial('photoForm', [
                'model' => $model ]),
            'footer'=> Html::submitButton(Yii::t('app','Commit'),['class'=>'btn btn-default']).
                Html::button(Yii::t('app','Close'),['class'=>'btn btn-default','data-dismiss'=>"modal"])

        ]);
    }

    public function actionShowPhoto($id)
    {
        $model  = Photos::findOne($id);
        return $this->jsonReturn([
            'title'=>Yii::t('app','View Picture'),
            'content'=>'<img class="img-responsive" src="'.$this->getThumbUrl($model->filepath).'">',
            'footer'=>
                Html::button(Yii::t('app','Close'),['class'=>'btn btn-default','data-dismiss'=>"modal"])

        ]);
    }



    /* 单页或列表 */
    public function actionLists($catid = 0)
    {
        if($catid)
        {
            $modelInfo = Content::getModelByCatid($catid);

            $datas = Content::search($catid);

            return $this->render('list',[
                'listData' => $datas['lists'],
                'pages' => $datas['pages'],
                'catid' => $catid,
                'catname'=>$modelInfo['catname']
            ]);


        }
        return $this->render('quick');

    }

    /* 更新单页 */
    public function actionUpdatePage($catid)
    {
        $model = Page::findOne(['catid'=>$catid]);
        $postData = Yii::$app->request->post();
        $model->updatetime = time();
        if($model->load($postData) && $model->save())
        {
            return $this->renderSuccess(Yii::t('app','Update Success'));
        }
        else
        {
            return $this->renderError($model);
        }

    }
    protected function changeAttachmentStatus($id)
    {
        $attachment = Attachment::findOne($id);
        if($attachment)
        {
            $attachment->status = 1;
            $attachment->save();
        }
    }

    public function actionDelete($id)
    {
        $model = Content::findOne($id);
        Content::deleteModel($model);
        return $this->jsonReturn([
            'title'=>Yii::t('app','Tip'),
            'content'=>Yii::t('app','Delete Success'),
            'refresh'=>'true'
        ]);
    }
    public function actionBatchDelete()
    {
        $ids = Yii::$app->request->post('id');
        if($ids)
        {
            foreach($ids as $v)
            {
                $model = Content::findOne($v);
                Content::deleteModel($model);
            }
        }
        return $this->jsonReturn([
            'state'=>0,
            'message'=>Yii::t('app','Delete Success'),
        ]);
    }


    public function actionCategorySearch($q)
    {
        $query = CategoryContent::find();

        $q = trim($q);
        $query->where(['like','catname',$q]);
        $lists = $query
            ->asArray()
            ->andWhere(['ispage'=>0])
            ->select('id,catname')
            ->all();
        if($lists)
        {
            return $this->jsonReturn([
                'state'=>0,
                'data'=>$lists
            ]);
        }
        else
        {
            return $this->jsonReturn([
                'state'=>1,
                'data'=>[]
            ]);
        }

    }

    //.导入数据
    public function actionImportData($catid)
    {
        if(Yii::$app->request->isPost)
        {
            $type = Yii::$app->request->post('type');
            $num = Yii::$app->request->post('num');
            if(!$num)
                $num = 20;


            $category = CategoryContent::findOne($catid);

            switch($category->model->type)
            {
                case Model::TYPE_CUSTOM:
                    $data = Collect::find()
                        ->where(['type'=>$type])
                        ->asArray()
                        ->limit($num)
                        ->all();
                    if($data)
                    {
                        foreach($data as $v)
                        {
                            $content = new Content();
                            $content->catid = $catid;
                            $content->title = $v['title'];
                            $content->status = 1;
                            $content->content = 'YANPHP模块化建站';
                            $content->description = $v['description']?:$v['title'];
                            if($v['thumb'])
                            {
                                $thumbFile = Yii::getAlias('@webroot/uploads/collect/').$v['thumb'];
                                if(is_file($thumbFile))
                                {
                                    @copy($thumbFile,Bridge::getRootPath().'uploads/content/'.$v['thumb']);
                                    $content->thumb = $v['thumb'];
                                }
                            }
                            $content->save();
                        }
                    }
                    break;
            }
            return $this->jsonReturn([
                'title'=>Yii::t('app','Tip'),
                'content'=>Yii::t('app','Success Import {num} Data',['num'=>$num]),
                'refresh'=>'true'
            ]);
        }
        return $this->jsonReturn([
            'title'=>Yii::t('app','Import'),
            'content'=>$this->renderPartial('importForm',['catid'=>$catid]),
            'footer'=>Html::submitButton(Yii::t('app','Import'),['class'=>'btn btn-default']).Html::button(Yii::t('app','Close'),['class'=>'btn','data-dismiss'=>'modal'])
        ]);
    }






}
