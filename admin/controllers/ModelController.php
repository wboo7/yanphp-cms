<?php
namespace admin\controllers;

use common\libs\Bridge;
use Yii;
use yii\db\Query;
use yii\filters\AccessControl;
use admin\controllers\BackendController;
use common\libs\Yanphp;
use common\models\Model;
use yii\helpers\Html;
use yii\web\NotFoundHttpException;



class ModelController extends BackendController
{

    public function actionIndex()
    {
        $query = Model::find();
        $lists = $query
            ->asArray()
            ->with('category')
            ->orderBy('id ASC')
            ->all();

        return $this->render('index', [
            'listData' => $lists
        ]);
    }

    public function actionCreate()
    {

        $id = Yii::$app->request->get('id');
        $pid = Yii::$app->request->get('pid');

        if($id)
        {
            $model = Model::findOne($id);
            if($model->system)
                return $this->renderError('出错啦,不能编辑系统模型！',true);
        }
        else
        {
            $model = new Model();
        }
        if($post = Yii::$app->request->post())
        {
            $model->load($post);
            ;
            if($model->validate())
            {
                //验证通过就要创建对应的文件
                $viewPath = Bridge::getViewPath().'default/';


                if($model->list_template && !file_exists($viewPath.$model->list_template.'.html'))
                    Bridge::createTpl($viewPath.$model->list_template.'.html');

                if($model->show_template && !file_exists($viewPath.$model->show_template.'.html'))
                    Bridge::createTpl($viewPath.$model->show_template.'.html');

                if($model->save())
                    return $this->renderSuccess('创建模型成功','?r=model/index');
                else
                    return $this->renderError($model);

            }
            else
            {
                return $this->renderError($model);
            }
        }
        else
        {
            if($pid)
            {
                $pModel = Model::findOne($pid);
                $model->list_template = $pModel->list_template;
                $model->show_template = $pModel->show_template;
                $model->tablename = $pModel->tablename;
                $model->type = $pModel->type;
            }
            return $this->render('_form',['model'=>$model]);
        }
    }

    public function actionDelete($id)
    {
        $model = Model::findOne($id);
        if($model->system)
        {
            return $this->jsonReturn([
                'title'=>'提示',
                'content'=>'不能删除系统默认的模型',
                'footer'=>Html::button('关闭',['class'=>'btn btn-default','data-dismiss'=>'modal'])
            ]);
        }


        if(!empty($model->category))
        {
            return $this->jsonReturn([
                'title'=>'提示',
                'content'=>'该模型下有栏目，请先删除栏目',
                'footer'=>Html::button('关闭',['class'=>'btn btn-default','data-dismiss'=>'modal'])
            ]);
        }


        $rootPath = Bridge::getRootPath();
        $proPath = $rootPath.'views/default/';


        if(file_exists($proPath.$model->list_template.'.html'))
            Bridge::deleteTpl($proPath.$model->list_template.'.html');

        if(file_exists($proPath.$model->show_template.'.html'))
            Bridge::deleteTpl($proPath.$model->show_template.'.html');

        $model->delete();
        return $this->jsonReturn([
            'title'=>'提示',
            'content'=>'删除模型成功',
            'refresh'=>'true'
        ]);


    }


}
