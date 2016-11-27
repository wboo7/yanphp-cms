<?php
namespace admin\controllers;

use common\models\Content;
use Yii;
use yii\db\Query;
use yii\filters\AccessControl;
use admin\controllers\BackendController;
use common\models\CategoryContent;
use common\libs\Yanphp;
use common\libs\Tree;
use common\models\Model;
use common\models\Page;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;
use yii\helpers\Url;
use yii\helpers\Html;
use common\helpers\ManagerHelper;

class CategoryContentController extends BackendController
{


    //栏目列表
    public function actionIndex()
    {
        $lists = CategoryContent::getConstruct();

        $tree = new tree();
        $tree->icon = array('&nbsp;&nbsp;&nbsp;│ ', '&nbsp;&nbsp;&nbsp;├─ ', '&nbsp;&nbsp;&nbsp;└─ ');
        $tree->nbsp = '&nbsp;&nbsp;&nbsp;';

        /* 格式化分类 */
        $format = [];

        foreach ($lists as $r) {
            $r['modelname'] = isset($r['model']['name']) ? $r['model']['name'] : '单页';
            $r['str_manage'] = '';
            $r['str_manage'] .= Html::a('', Url::to(['category-content/create', 'parentid' => $r['id']]), ['class' => 'fa fa-plus', 'title' => '添加子栏目']) . ' ';
            $r['str_manage'] .= Html::a('', Url::to(['category-content/create', 'id' => $r['id']]), ['class' => 'fa fa-pencil', 'title' => '修改']) . ' ';
            $r['str_manage'] .= '<a data-confirm-title="提示" data-confirm-message="确定删除吗？此操作会删除所有子栏目和对应的文章！" role="modal-remote" class="fa fa-trash" data-url="'.Url::to(['category-content/delete', 'id' => $r['id']]).'">';
            $format[$r['id']] = $r;
        }
        $tree->init($format);
        $categorys = $tree->get_tree_lists(0);

        return $this->render('index', [
            'categorys' => $categorys
        ]);
    }

    //.栏目创建
    public function actionCreate($parentid = 0, $id = 0)
    {
        //.修改
        if ($id)
        {
            $model = CategoryContent::findOne($id);
        }
        //.添加
        else
        {
            $model = new CategoryContent();
            $model->loadDefaultValues();
        }


        if ($post = Yii::$app->request->post()) {
            $model->load($post);

            if ($model->save()) {
                if($model->listorder == 0)
                {
                    $model->listorder = $model->id;
                    $model->save(false);
                }

                CategoryContent::clearCache();
                return $this->renderSuccess(Yii::t('app','Operate Success'), '?r=category-content/index');

            } else {
                return $this->renderError($model);
            }

        }
        else
        {
            $modeldata = Model::getAll();
            if ($parentid) {
                $model->parentid = $parentid;
                $cinfo = ArrayHelper::toArray(CategoryContent::findOne($parentid));
                $cinfo['format_name'] = $cinfo['catname'];
                $categorys[] = $cinfo;
                $model->modelid = $cinfo['modelid'];
            } else {
                $lists = CategoryContent::getAll();
                $tree = new Tree();
                $tree->init($lists);
                $categorys = $tree->get_tree_simple(0);
                $categorys = $categorys?:[];

                array_unshift($categorys, ['id' => 0, 'format_name' => '顶级栏目']);

            }


            return $this->render('form', [
                'model' => $model,
                'modeldata' => $modeldata,
                'categorys' => $categorys,

            ]);
        }

    }


    /*
     * 删除栏目和其所有子栏目
     * */
    public function actionDelete($id)
    {

        $model = CategoryContent::findOne($id);

        if($model)
        {
            if($model->children)
            {
                return $this->jsonReturn([
                    'title'=>'提示',
                    'content'=>'该栏目下有子栏目，请先删除子栏目！',
                    'footer'=>Html::button('关闭',['class'=>'btn btn-default','data-dismiss'=>'modal'])
                ]);
            }

            if($model->contents)
            {
                foreach($model->contents as $content)
                {
                    Content::deleteModel($content);
                }
            }

            $model->delete();
            CategoryContent::clearCache();
            return $this->jsonReturn([
                'title'=>'提示',
                'content'=>'删除成功',
                'refresh'=>'true'
            ]);
        }
        else
        {
            return $this->jsonReturn([
                'title'=>'提示',
                'content'=>'删除失败',
                'refresh'=>Html::button('关闭',['class'=>'btn btn-default','data-dismiss'=>'modal'])
            ]);
        }


    }

    protected function findModel($catid)
    {
        if (($model = CategoryContent::findOne($catid)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionSort($id, $act)
    {
        $catModel = CategoryContent::findOne($id);
        $siblings = CategoryContent::find()->asArray()->where(['parentid'=>$catModel->parentid])->orderBy('listorder ASC')->all();
        $total = count($siblings);
        $index = $this->index($siblings,$id);

        if($total == 1)
            return $this->redirect(['category-content/index']);

        if($index == 0 && $act == 'up')
            return $this->redirect(['category-content/index']);
        if($index == ($total-1) && $act == 'down')
            $this->redirect(['category-content/index']);
        switch($act)
        {
            case 'up':

                $model = CategoryContent::findOne($id);
                $nextModel = CategoryContent::findOne($siblings[$index-1]['id']);
                $curOrder = $model->listorder;
                $nextOrder = $nextModel->listorder;

                $model->listorder = $nextOrder;
                $model->save(false);

                $nextModel->listorder = $curOrder;
                $nextModel->save(false);

                break;
            case 'down':
                $model = CategoryContent::findOne($id);
                $nextModel = CategoryContent::findOne($siblings[$index+1]['id']);
                $curOrder = $model->listorder;
                $nextOrder = $nextModel->listorder;

                $model->listorder = $nextOrder;
                $model->save(false);

                $nextModel->listorder = $curOrder;
                $nextModel->save(false);
                break;
        }
        CategoryContent::clearCache();
        $this->redirect(['category-content/index']);




    }
    protected function index($arr,$cur)
    {
        foreach($arr as $k=>$v)
        {
            if($v['id'] == $cur)
                return $k;
        }
    }

    protected function getTotal($cid,$modelid)
    {
        $model = Model::findOne($modelid);
        if(!$model)
            return '--';

        $count = Content::find()
            ->where(['catid'=>$cid])
            ->count();

        return $count;

    }




}
