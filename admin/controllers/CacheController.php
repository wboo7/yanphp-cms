<?php
namespace admin\controllers;

use Yii;
use admin\controllers\BackendController;
use common\libs\Yanphp;

use yii\db\Query;


class CacheController extends BackendController
{

    public $layout = 'main';
    public $enableCsrfValidation = false;

    public function actionIndex()
    {

        $query = new Query();
        if($postData = Yii::$app->request->post())
        {
            if(isset($postData['clear_cache']))
            {
                Yanphp::flushCache();
            }
            if(isset($postData['clear_asset']))
            {
                //
            }
            return $this->renderSuccess('清除成功');
        }
        else
        {

            return $this->render('index');
        }
    }


}
