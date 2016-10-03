<?php

namespace admin\controllers;

use Yii;
use common\models\Attachment;
use yii\data\ActiveDataProvider;
use admin\controllers\BackendController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;
use common\helpers\File;

/**
 * AttachmentController implements the CRUD actions for Attachment model.
 */
class AttachmentController extends BackendController
{
    public $layout = 'dialog';
    public $enableCsrfValidation = false;

    public function init()
    {

        /* 建立会话 */
        if (isset($_REQUEST["PHPSESSID"])) {
            session_id($_REQUEST["PHPSESSID"]);
        }

        parent::init();
    }
    public function behaviors()
    {
        return [
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'delete' => ['POST'],
//                ],
//            ],
        ];
    }

    /**
     * Lists all Attachment models.
     * @return mixed
     */
    public function actionIndex()
    {

        $query = Attachment::find();
        if(isset($_GET['status']))
            $query->where('status='.$_GET['status']);
        $count = $query->count();
        $pages = new Pagination(['totalCount'=>$count]);
        $pages->setPageSize(5);

        $listData = $query
            ->asArray()
            ->orderBy('id DESC')
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        $unuse = Attachment::find()->where('status=0')->count();
        return $this->render('index', [
            'listData' => $listData,
            'pages'=>$pages,
            'unuse'=>$unuse
        ]);
    }



    /**
     * Creates a new Attachment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Attachment();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }



    /**
     * Deletes an existing Attachment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        $this->ajaxReturn('success');
    }

    /**
     * Finds the Attachment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Attachment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Attachment::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionSwfupload()
    {
        $get = Yii::$app->request->get();
        if(md5($get['textareaid'].','.$get['module']) != $get['authkey'])
        {
            exit;
        }
        return $this->render('swfupload',[
            'fileTypes' => $get['fileTypes'],
            'module' => $get['module'],
            'textareaid'=>$get['textareaid'],
            'callback'=>$get['callback'],

        ]);
    }


    public function actionDoswfupload()
    {

        $postData = Yii::$app->request->post();
        if (!isset($_FILES["Filedata"]) || !is_uploaded_file($_FILES["Filedata"]["tmp_name"]) || $_FILES["Filedata"]["error"] != 0) {
            echo "错误:无效的上传!";
            exit(0);
        }
        /* 判断扩展类型为图片 */
        $file_types = explode(".", $_FILES["Filedata"]["name"]);
        $file_type = $file_types[count($file_types) - 1];
        /* 创建图像资源$img */

        if (strtolower($file_type) == 'gif') {
            $img = imagecreatefromgif($_FILES["Filedata"]["tmp_name"]);
        } else if (strtolower($file_type) == 'png') {
            $img = imagecreatefrompng($_FILES["Filedata"]["tmp_name"]);
        } else if (strtolower($file_type) == 'bmp') {
            $img = imagecreatefromwbmp($_FILES["Filedata"]["tmp_name"]);
        } else {
            $img = imagecreatefromjpeg($_FILES["Filedata"]["tmp_name"]);
        }

        if (!$img) {
            echo "错误:无法创建图像 " . $_FILES["Filedata"]["tmp_name"];
            exit(0);
        }
        /* 获取实际图像的宽高 */
        $width = imageSX($img);
        $height = imageSY($img);

        if (!$width || !$height) {
            echo "错误：无效的高或高";
            exit(0);
        }

        // 不是宽100，就是高100
        $thumb = !isset($postData['ys']) ? $width :180;
        if ($width > $height) {
            $new_width = $thumb;
            $new_height = round($thumb / $width * $height);
        } else {
            $new_width = round($thumb / $width * $height);
            $new_height = $thumb;
        }

        /* 创建一个画布资源 $new_img */
        $new_img = ImageCreateTrueColor($new_width, $new_height);
        //3.设置透明
        imagealphablending($new_img, false);//取消默认的混色模式（为解决阴影为绿色的问题）
        imagesavealpha($new_img,true);//设定保存完整的 alpha 通道信息（为解决阴影为绿色的问题）
        imagecopyresized($new_img, $img , 0 , 0 , 0 , 0 , $new_width , $new_height , $width , $height);
        $time = time();

        $filepath =  $this->getProgramePath().$postData['module'].'/'.date('Y',$time)."/".date('md',$time)."/";
        if(!is_dir($filepath)) File::dir_create($filepath);
        $filename = $time.'.'.$file_type;
        imagejpeg($new_img,$filepath.$filename,100);
        $filesize =filesize($filepath.$filename);
        //入库
        $attachment = new Attachment();
        $data['Attachment'] = [
            'module' => $postData['module'],

            'filename' => $filename,
            'filepath' => $filepath.$filename,
            'filesize' => $filesize,
            'fileext' => $file_type,
            'isimage' => 1,
            'isthumb' => 1,
            'downloads' => 0,
            'uploadtime' => time(),
            'uploadip' => Yii::$app->request->userIP,
            'status' => 0,
        ];
        if($attachment->load($data) && $attachment->save())
            echo '1,'.$filepath.$filename.','.$attachment->id;



    }

    //清理碎片
    public function actionClean()
    {
         $list = Attachment::find()->where('status=0')->all();
         foreach($list as $v)
         {
             Attachment::deleteAll('id='.$v->id);
             @unlink($v->filepath);
         }
         $this->ajaxReturn('success');

    }

    //ajax 分页图库
    public function actionAjaxTk()
    {
        //图库
        $query = Attachment::find();
        $count = $query->count();
        $pages = new Pagination(['totalCount'=>$count]);
        $pages->setPageSize(8);

        $tk_datas = $query
            ->asArray()
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy('id DESC')
            ->all();
       $html = $this->renderPartial('ajaxTk',[
           'tk_datas'=>$tk_datas,
           'pages'=>$pages
       ]);
       exit($html);
    }
}
