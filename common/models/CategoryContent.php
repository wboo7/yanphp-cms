<?php

namespace common\models;

use common\libs\Bridge;
use Yii;
use yii\db\ActiveRecord;
use common\models\Model;
use yii\db\Query;
use yii\helpers\Url;

/**
 * 内容分类模型
 */
class CategoryContent extends ActiveRecord
{

    const cacheKey = 'content_category';
    public static $categorys = null;


    public static function tableName()
    {
        return '{{%category_content}}';
    }

    public function rules()
    {
        return [
            [['catname', 'modelid', 'parentid', 'ismenu'], 'required'],
            ['content','string'],
            [['modelid','listorder','ismenu','parentid'],'integer']

        ];
    }

    public function attributeLabels()
    {
        return [
            'modelid' => Yii::t('app','Model Name'),
            'parentid' => Yii::t('app','Parent Category'),
            'catname' => Yii::t('app','Category Name'),
            'content'=>Yii::t('app','Content'),
            'ismenu' => Yii::t('app','Show In Nav'),
            'list_template' => Yii::t('app','Category List Template'),
            'show_template' => Yii::t('app','Category Show Template'),
            'keywords' => Yii::t('app','Category Keyword'),
            'description' => Yii::t('app','Category Description'),

        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['listorder'] = ['listorder'];
        return $scenarios;

    }


    /* 关联model */
    public function getModel()
    {
        return $this->hasOne(Model::className(), ['id' => 'modelid']);
    }




    public function getChildren()
    {
        return $this->hasMany(self::className(), ['parentid' => 'id']);
    }


    /*
     * 查找所有分类
     * */
    public static function getAll()
    {
        $query = self::find();

        $lists = $query
            ->asArray()
            ->with('model')
            ->orderBy('listorder ASC,id ASC')
            ->all();

        return $lists;
    }

    /*
     *  @获取无限极分类
     * */
    public function getListsChilds()
    {
        $lists = CategoryContent::getAll();
        $category = $this->findSub($lists, 0);
        return $category;

    }
    public function getContents()
    {

        return $this->hasMany(Content::className(),['catid'=>'id']);
    }

    /*
     * @遍历数组获取子分类
     * */
    public function findSub($lists, $parentid)
    {
        $arr = [];
        foreach ($lists as $v) {
            if ($v['parentid'] == $parentid) {
                $sub = $this->findSub($lists, $v['id']);
                $v['sub'] = $sub;
                $arr[] = $v;
            }
        }
        return $arr;
    }



    public static function getAllCategory()
    {
        if(self::$categorys === null)
        {
            $categorys = self::find()
                ->asArray()
                ->with('model')
                ->indexBy('id')
                ->orderBy('listorder ASC,id DESC')
                ->all();
            self::$categorys = $categorys;
        }
        return self::$categorys;


    }

    public static function findChild(&$arr,$id,$ismenu){

        $childs=array();
        foreach ($arr as $k => $v){

            if($v['parentid']== $id){
                $v['url'] = Url::to([$v['model']['type'] == Model::TYPE_PAGE ? 'page':'lists','catid'=>$v['id']]);
                if($ismenu)
                {
                    if($v['ismenu'])
                        $childs[]=$v;
                }
                else
                {
                    $childs[]=$v;
                }

            }
        }
        return $childs;

    }
    public static function buildTree($root_id,$ismenu=false){
        $rows = self::getAllCategory();
        $childs= self::findChild($rows,$root_id,$ismenu);
        if(empty($childs)){
            return null;
        }
        foreach ($childs as $k => $v){
            $childs[$k]['url'] = Url::to([$v['model']['type'] == Model::TYPE_PAGE ? 'page':'lists','catid'=>$v['id']]);
            $rescurTree=self::buildTree($v['id']);
            if( null !=   $rescurTree){
                $childs[$k]['children']=$rescurTree;
            }
        }
        return $childs;
    }
    public static function buildParent(&$info,$categorys,&$origon)
    {

        if($info['parentid'] == 0 || !isset($categorys[$info['parentid']]))
        {
            return;
        }
        $info['parent'] = $categorys[$info['parentid']];
        $info['parent']['url'] = Url::to([$info['parent']['model']['type'] == Model::TYPE_PAGE ? 'page':'lists','catid'=>$info['parent']['id']]);

        $origon['parents'] = isset($origon['parents'])?$origon['parents']: [];
        array_unshift($origon['parents'],$categorys[$info['parentid']]);
        //  $origon['parents'][] = $categorys[$info['parentid']];
        self::buildParent($info['parent'],$categorys,$origon);

    }
    /*
     * @获取分类的信息
     * */
    public static function getInfo($catid)
    {

        $construct = self::getConstruct();

        return $construct[$catid];
    }

    //获取所有栏目的结构,具有缓存效果
    public static function getConstruct()
    {
        Bridge::setCatchPath();
        $key = self::cacheKey;
        $cache = Yii::$app->cache;
        $data = $cache->get($key);

        if($data === false)
        {
            $rows = self::getAllCategory();
            $data = [];
            foreach($rows as $k=>$v)
            {
                $data[$k] = self::relation($v,$rows);
            }
            $cache->set($key,$data);
        }
        return $data;
    }

    public static function clearCache()
    {
        Bridge::setCatchPath();
        Yii::$app->cache->delete(self::cacheKey);
    }
    public static function relation($data)
    {
        $data['url'] = Url::to([$data['model']['type'] == Model::TYPE_PAGE ? 'page':'lists','catid'=>$data['id']]);
        $rows = self::getAllCategory();
        $children = self::buildTree($data['id']);
        $data['children'] = $children;
        self::buildParent($data,$rows,$data);
        return $data;
    }

    public function getParent()
    {
        return $this->hasOne(self::className(), ['id' => 'parentid']);
    }

    /*删除栏目 子栏目 */
    public function categoryDelete()
    {
        $command = Yii::$app->db->createCommand();
        $models = self::findAll(['parentid' => $this->id]);
        if ($models) {
            foreach ($models as $model) {
                $command->delete('{{%content}}', ['catid' => $model->id])->execute();
                $model->delete();
            }
        }
        $this->delete();
        return true;

    }


}
