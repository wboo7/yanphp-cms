<?php
namespace admin\controllers;
use common\models\Msg;
use Yii;
use admin\controllers\BackendController;
use yii\bootstrap\Html;
use yii\filters\VerbFilter;
use yii\db\Query;
use yii\data\Pagination;



class MsgController extends BackendController
{

    public $layout = 'main';
    public $enableCsrfValidation = false;

    //首页
    public function actionIndex()
    {

        $connection = Yii::$app->db;
        $fields = $connection->createCommand("SHOW full FIELDS FROM {{%msg}}")->queryAll();
        $count = $connection->createCommand("SELECT COUNT(*) FROM {{%msg}};")->queryScalar();
        $pages = new Pagination(['totalCount' => $count]);
        $pages->setPageSize(15);
        $listData = $connection->createCommand("SELECT * FROM {{%msg}} ORDER BY id DESC LIMIT {$pages->offset},{$pages->limit}")->queryAll();
        foreach($listData as $k=>$v)
        {
            $listData[$k]['gender'] = $listData[$k]['gender'] ? '男' : '女';
            $listData[$k]['create_time'] = date('Y-m-d H:i',$listData[$k]['create_time']);
        }
        return $this->render('index',[
            'fields'=>$fields,
            'listData'=>$listData,
            'pages'=>$pages
        ]);
    }

    //管理表单
    public function actionForm()
    {
        $connection = Yii::$app->db;
        $fields = $connection->createCommand("SHOW full FIELDS FROM {{%msg}}")->queryAll();
        return $this->render('form',[
            'fields'=>$fields
        ]);
    }
    //添加字段
    public function actionCreate()
    {
        if($postData = Yii::$app->request->post())
        {
            $connection = Yii::$app->db;
            $fields = $connection->createCommand("SHOW full FIELDS FROM {{%msg}}")->queryAll();
            $default = [];
            foreach($fields as $v)
            {
                $default[] = $v['Field'];
            }
            $field = trim(strtolower($postData['field']));
            $comment = trim($postData['comment']);
            $type = $postData['type'];
            $length = intval($postData['length']);

            if(in_array($field,$default))
                $this->ajaxReturn('fail','标识重复了');
            if(!preg_match('~^[a-z]{2,10}$~',$field))
                $this->ajaxReturn('fail','标识不规范');
            if(empty($comment))
                $this->ajaxReturn('fail','注释为空');
            if($type)
            {
                if($length>11 || $length<1)
                    $this->ajaxReturn('fail','长度不规范');
            }
            else
            {
                if($length>256 || $length<1)
                    $this->ajaxReturn('fail','长度不规范');
            }

            $type = $type ? 'INT':'VARCHAR';
            $result = $connection->createCommand("ALTER TABLE {{%msg}} ADD COLUMN {$field} {$type}({$length}) COMMENT '{$comment}';")
                ->execute();
            if($result)
            {
                return $this->jsonReturn([
                    'title'=>'提示',
                    'content'=>'添加字段成功！',
                    'refresh'=>'true'
                ]);
            }

        }
        else
        {
            return $this->jsonReturn([
                'title'=>'提示',
                'content'=>$this->renderPartial('_form'),
                'footer'=>Html::submitButton('确定',['class'=>'btn btn-default']).Html::button('关闭',['class'=>'btn','data-dismiss'=>'modal'])
            ]);
        }
    }

    //删除列
    public function actionDrop()
    {
        $field = Yii::$app->request->get('field');
        $connection = Yii::$app->db;
        $result = $connection->createCommand("ALTER TABLE {{%msg}} DROP COLUMN {$field};")->execute();
        if($result)
        {
            return $this->jsonReturn([
                'title'=>'提示',
                'content'=>'删除成功！',
                'refresh'=>'true'
            ]);
        }
    }

    //.删除留言
    public function actionDelete($id)
    {
        $model = Msg::findOne($id);
        if(!$model)
            return;
        $model->delete();
        return $this->jsonReturn([
            'title'=>'提示',
            'content'=>'删除成功！',
            'refresh'=>'true'
        ]);
    }

}
