<?php
/*
 *   内容模型  动态的
 * */
namespace common\models;

use common\libs\Bridge;
use common\libs\Yanphp;
use Yii;
use yii\db\ActiveRecord;

/**
 * 内容模型
 */
class Config extends ActiveRecord
{
    const CachePrefix='config_';

    const TYPE_INPUT = 0;
    const TYPE_IMAGE = 1;
    const TYPE_TEXTAREA = 2;


    public static function tableName()
    {
        return '{{%config}}';
    }

    public function rules()
    {
        return [
            ['id', 'unique', 'targetClass' => '\common\models\Config', 'message' => '英文名称重复'],
            ['name', 'unique', 'targetClass' => '\common\models\Config', 'message' => '中文名称重复'],
            [['id','name','type'],'required']
        ];
    }
    public function attributeLabels()
    {
        return [
            'id'=>'英文名称',
            'name'=>'中文名称',
            'type'=>'配置类型',
        ];
    }

    public static function getModel($id,$fromCache=true)
    {
        $cacheKey = self::CachePrefix.$id;

        $model = $fromCache? self::getCache($cacheKey) : false;

        if($model===false)
        {
            $model = Config::findOne(['id'=>$id]);
            if($model !== null)
            {
                self::setCache($cacheKey, $model);
            }
        }
        return $model;
    }
    public static function getCache($key)
    {
        Bridge::setCatchPath();
        $cache = Yii::$app->cache;
        return $cache->get($key);
    }
    public static function setCache($key, $value, $duration = 0, $dependency = null)
    {
        Bridge::setCatchPath();
        $cache = Yii::$app->cache;
        return $cache->set($key, $value,$duration,$dependency);
    }
    public static function deleteCache($key)
    {
        Bridge::setCatchPath();
        $cacheKey = self::CachePrefix.$key;
        $cache = Yii::$app->cache;

        $cache->delete($cacheKey);
    }

    /*
     * @获取配置的值
     * */
    public static function  getValue($id,$fromCache=false)
    {

        $model = self::getModel($id, $fromCache);
        if($model===null)
        {
            return '';
        }
        if($model->type == Config::TYPE_IMAGE)
        {
            return Bridge::getRootUrl().'uploads/config/'.$model->value;
        }
        else
        {
            return $model->value;
        }

    }


}
