<?php
namespace common\helpers;
use common\libs\Yanphp;
use common\models\CategoryContent;
use yii;
use yii\base\Component;
use common\models\Content;

class Dispatch extends Component{
    public  $content = null;
    public  function run($op,$data)
    {
        switch($op){
            case 'content':
                $matches = $this->parseTag($data);
                $content = new Content();
                if(isset($matches['action']) && $matches['action'])
                {
                    if(!method_exists($content,$matches['action']))
                    {
                        echo Yii::t('app','unknown action',[
                            'action'=>$matches['action']
                        ]);
                        return [];
                    }
                    $data = call_user_func([$content,$matches['action']],$matches);
                }
                else
                {
                    echo Yii::t('app','missing action');
                    return [];
                }
                return $data;
                break;
        }
    }

    protected function parseTag($data)
    {
        preg_match_all("/([a-z]+)\=[\"]?([^\"]+)[\"]?/i", stripslashes($data), $matches, PREG_SET_ORDER);
        $arr = [];
        if(!empty($matches))
        {
            foreach($matches as $v)
            {
                $arr[$v[1]] = $v[2];
            }
        }

        return $arr;

    }
    public function getContent()
    {

        if($this->content == null)
        {
            $id = Yii::$app->request->get('id');
            if($id)
            {
                $this->content = Content::findOne($id);
            }
            return $this->content;
        }
        else
        {
            return $this->content;
        }

    }
    /*
     * 判断是不是当前页
     *  $cur 栏目id或字符串index|msg
     * */
    public function isCur($cur)
    {

        $catid = Yii::$app->request->get('catid');
        $id = Yii::$app->request->get('id');

        if(!$catid)
        {
            $content = $this->getContent();
            if($content)
                $catid = $content->catid;
        }


        if($cur == Yii::$app->controller->action->id)
        {
            return 1;
        }
        else
        {
            if($catid == $cur)
                return 1;
            $construct = CategoryContent::getConstruct();
            $info = $construct[$catid];

            $pids = [];
            if($info['parents'])
            {
                foreach($info['parents'] as $v)
                {
                    $pids[] = $v['id'];
                }
            }

            if(in_array($cur,$pids))
                return 1;
            else
                return 0;

        }


    }
    public function getParents($catid)
    {
        static $parents=[];
        if(!$catid)
            return [];
        $model = CategoryContent::findOne($catid);
        if(!$model)
            return [];

        if($model->parentid !== 0)
        {
            $parents[] = $model->parentid;

            $this->getParents($model->parentid);
        }

        return $parents;


    }

    public  function strcut($string, $length, $etc = '...')
    {
        return Yanphp::strcut($string, $length, $etc);
    }

    public function date($format,$timestamp)
    {
        return date($format,$timestamp);
    }
}