<?php
namespace frontend\modules\content\controllers;

use common\libs\Yanphp;
use common\models\Page;
use Yii;
use yii\base\InvalidParamException;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;
use yii\db\Query;
use yii\helpers\Url;
use common\models\Msg;
use common\models\Form;

use common\models\Content;
use common\models\CategoryContent;
use common\models\Config;
use common\models\Analysis;

use frontend\modules\content\controllers\BaseController;


class DefaultController extends BaseController
{
    public $enableCsrfValidation = false;

    public function init()
    {
        parent::init();

        //数据统计
        if($ip = Yii::$app->request->userIP != '127.0.0.1')
        {
//            $model = new Analysis([
//                'url'=>Yii::$app->request->getHostInfo().Yii::$app->request->getUrl(),
//                'ua'=>Yii::$app->request->userAgent,
//                'ip'=>$ip,
//                'created_at'=>time()
//
//            ]);
//            $model->save(false);
        }

        Yii::$app->set('view', [
            'class' => 'yii\web\View',
            'defaultExtension' => 'html',
            'renderers' => [
                'html' => [
                    'class'=>'frontend\extensions\Template',
                    'app'=>Yii::$app,
                    'config_vars'=>Yii::$app->params,
                    'viewPath'=>$this->getViewPath().DIRECTORY_SEPARATOR,

                ]
            ]
        ]);
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'minLength'=> 4,
                'maxLength'=> 4,
                'width'=>70,
                'height'=>30,
                'padding'=>2

            ],
        ];
    }

    /*
     * 首页
     * */
    public function actionIndex()
    {

        return $this->renderPartial('index', [
            'template' => 'index',
            'data' => [
                'catid' => 0,
                'title' => Yanphp::getConfigValue('site_title', true),
                'keywords' => Yanphp::getConfigValue('site_keywords', true),
                'description' => Yanphp::getConfigValue('site_description', true),
            ]
        ]);
    }

    /*
     *  @列表
     * */
    public function actionLists($catid)
    {

        $category = CategoryContent::getInfo($catid);

        $template = $category['model']['list_template'];

        return $this->renderPartial($template, [
            'template' => $template,
            'data' => [
                'title' => $category['catname'],
                'keywords' => $category['keywords'],
                'description' => $category['description'],
                'catid' => $catid,
                'category' => $category,
                'parentid'=>$category['parentid'],
                'page' => isset($_GET['page']) ? intval($_GET['page']) : 1
            ]
        ]);


    }


    public function actionPage($catid)
    {
        $category = CategoryContent::getInfo($catid);
        $template = $category['model']['show_template'];

        return $this->renderPartial($template, [
            'template' => $template,
            'data' => [
                'title' => $category['catname'],
                'keywords' => $category['keywords'],
                'description' => $category['description'],
                'catid' => $catid,
                'category' => $category,
                'parentid'=>$category['parentid'],
            ]
        ]);

    }


    /*
  *  @show
  * */
    public function actionShow($id)
    {
        $model = Content::findOne($id);
        if(!$model)
            return;
        $model->click = $model->click+1;
        $model->save(false);
        $category = CategoryContent::getInfo($model->catid);

        $template = $category['model']['show_template'];
        $data = ArrayHelper::toArray($model);
        $data['category'] = $category;
        $data['parentid'] = $category['parentid'];
        $data['pre'] = Content::find()
            ->asArray()
            ->where(['catid'=>$model->catid,'status'=>1])
            ->andWhere(['<','id',$model->id])
            ->orderBy('id DESC')
            ->one();
        if($data['pre'])
        {
            $data['pre']['url'] = Url::to(['/show/' . $data['pre']['id']]);
            $data['pre']['thumb'] = Content::getThumbUrl($data['pre']['thumb']);
        }
        $data['next'] = Content::find()
            ->asArray()
            ->where(['catid'=>$model->catid,'status'=>1])
            ->andWhere(['>','id',$model->id])
            ->orderBy('id ASC')
            ->one();
        if($data['next'])
        {
            $data['next']['url'] = Url::to(['/show/' . $data['next']['id']]);
            $data['next']['thumb'] = Content::getThumbUrl($data['next']['thumb']);
        }
        $this->renderPartial($template, [
            'template' => $template,
            'data' => $data
        ]);
    }

    public function actionCategory($catid)
    {

        $category = CategoryContent::getInfo($catid);

        $this->renderPartial($category['model']['category_template'], [
                'template' => $category['model']['category_template'],
                'data' => [
                    'catid' => $catid,
                    'title' => $category['catname'],
                    'keywords' => $category['meta_keywords'],
                    'description' => $category['meta_description']
                ]
            ]
        );
    }

    public function actionTest()
    {

        $data = Yii::$app->db->createCommand("SELECT * FROM {{%news}}")->queryOne();
        pre($data);
    }
    //.form
    public function actionForm($formid)
    {

        $form = Form::findOne($formid);
        if(!$form)
            throw new ErrorException('表单不存在！');
        if(!$form->status)
        {
            return $this->jsonReturn([
                'state'=>1,
                'message'=>'管理员已关闭提交！'
            ]);
        }

        if($post = Yii::$app->request->post())
        {
            $captcha = $this->createAction('captcha');
            if($post['captcha'] != $captcha->getVerifyCode())
            {
                return $this->jsonReturn([
                    'state'=>1,
                    'message'=>'图形码有误！'
                ]);
            }
            else
            {
                $captcha->getVerifyCode(true);
            }
            $time = time();
            $insertData = [
                'created_at'=>$time,
                'updated_at'=>$time,
                'created_ip'=>Yii::$app->request->userIP
            ];
            $insertData = array_merge($insertData,$post);
            $columns = Yii::$app->db->getTableSchema($form->table_name)->columns;
            $keys = array_keys($columns);
            foreach($insertData as $k=>$v)
            {
                if(!in_array($k,$keys))
                {
                    unset($insertData[$k]);
                }
            }

            Yii::$app->db->createCommand()->insert($form->table_name,$insertData)->execute();

            return $this->jsonReturn([
                'state'=>0,
                'message'=>'留言成功，感谢您的参与！',
                'captchaUrl' => Url::to([$captcha->id, 'v' => uniqid()]),
            ]);
        }

    }

    //模块
    public function actionMod($name, $act)
    {

        $this->$name($act);
    }


    //模块  留言
    private function msg($act)
    {
        switch ($act) {
            case 'add':
                if ($postData = Yii::$app->request->post()) {
                    $connection = Yii::$app->db;
                    $postData['create_time'] = time();
                    $postData['create_ip'] = Yii::$app->request->userIP;

                    $result = $connection->createCommand()->insert('{{%msg}}', $postData)->execute();

                    $this->redirect(['mod', 'name' => 'msg', 'act' => 'add']);
                } else {
                    return $this->render('msg-add', [
                        'template' => 'msg-add',
                        'data' => [
                            'SEO' => [
                                'title' => Yanphp::getConfigValue('site_title', true) . '-留言板',
                                'keywords' => Yanphp::getConfigValue('site_title', true),
                                'description' => Yanphp::getConfigValue('site_title', true)
                            ]
                        ]
                    ]);
                }

                break;
            case "lists":
                return $this->render('msg-lists', [
                    'template' => 'msg-lists',
                    'data' => [
                        'SEO' => [
                            'title' => Yanphp::getConfigValue('site_title', true) . '-留言板',
                            'keywords' => Yanphp::getConfigValue('site_title', true),
                            'description' => Yanphp::getConfigValue('site_title', true)
                        ]
                    ]
                ]);
                break;
            default:
                exit('unknown action.');
        }
    }
    //.搜索
    public function actionSearch()
    {
        $catid = Yii::$app->request->get('catid',0);
        $title  = Yii::$app->request->get('title','');

        return $this->renderPartial('search',[
            'template'=>'search',
            'data'=>[
                'title' => '站内搜索',
                'keywords' => '',
                'description' => '',
                'catid'=>$catid,
                'title'=>$title
            ]
        ]);
    }
    /* ==== 管理控制台的子接口=====*/


    public function getViewPath()
    {

            return $this->module->getViewPath() . DIRECTORY_SEPARATOR . $this->id;

    }


}
