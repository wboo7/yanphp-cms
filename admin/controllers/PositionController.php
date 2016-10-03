<?php
namespace admin\controllers;

use common\models\CategoryContent;
use common\models\Content;
use Yii;

use common\models\Position;
use common\models\PositionCategory;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;


class PositionController extends BackendController
{

    public function actionIndex()
    {
        $query = Position::find();
        $totalCount = $query->count();
        $pages = new Pagination(['totalCount'=>$totalCount]);
        $pages->setPageSize(15);
        $listData = $query
            ->asArray()
            ->with('content')
            ->with(['categoryContent' => function ($query) {
                $query->with('model');
            }])
            ->with('category')
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy('pid ASC')
            ->all();



        return $this->render('index', [
            'listData' => $listData,
            'pages'=>$pages
        ]);
    }

    public function actionLists()
    {
        $query = PositionCategory::find();
        $listData = $query
            ->asArray()
            ->all();
        return $this->render('lists', [
            'listData' => $listData
        ]);
    }

    public function actionCreate()
    {

        $id= Yii::$app->request->get('id');
        if($id)
            $model = PositionCategory::findOne($id);
        else
            $model = new PositionCategory();

        if($postData = Yii::$app->request->post())
        {
            if($model->load($postData) && $model->save())
            {
                $this->ajaxReturn('success',Yii::t('app','Operate Success'));
            }
            else
            {
                $this->ajaxReturn('fail',Yii::t('app','Operate Fail'));
            }
        }
        return $this->render('_form',['model'=>$model]);


    }
    public function actionDelete($id)
    {
        $model = Position::findOne($id);
        if($model->delete())
            $this->ajaxReturn('success',Yii::t('app','Delete Success'));
        else
            $this->ajaxReturn('fail',Yii::t('app','Delete Fail'));

    }

    /*
     * 删除推荐位以及数据
     * */
    public function actionDeleteCategory($id)
    {

        $model = PositionCategory::findOne($id);
        if(!$model)
            $this->ajaxReturn('fail',Yii::t('app','Unknown Record'));

        if($model->contents)
        {
            foreach($model->contents as $v)
            {
                $v->delete();
            }
        }

        if($model->delete())
            $this->ajaxReturn('success',Yii::t('app','Delete Success'));
        else
            $this->ajaxReturn('fail',Yii::t('app','Operate Fail'));
    }


}
