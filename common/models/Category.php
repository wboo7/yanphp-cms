<?php
/*
 *   内容模型  动态的
 * */
namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * 内容模型
 */
class Category extends ActiveRecord
{


    public static function tableName()
    {
        return '{{%category}}';
    }

    public static function getInfo($catid)
    {
        $info = self::find()
            ->select(['catid','modelid','module'])
            ->where('catid='.$catid)
            ->asArray()
            ->one();
        return $info;
    }

}
