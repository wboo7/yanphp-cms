<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;


class Photos extends ActiveRecord
{


    public function rules()
    {
        return [
            [['contentid','filepath'], 'required','on'=>'default'],
//            ['name', 'required','on'=>'photoName'],


        ];
    }

    public function attributeLabels()
    {
        return [
            'id'=>'标识',
            'name'=>'图片描述',
            'contentid'=>'内容标识',
            'filepath'=>'图片路劲',
        ];
    }

    public function scenarios()
    {
        return array_merge(parent::scenarios(),[
           'photoName'=>[
               'name'
           ]
        ]);
    }

    public static function tableName()
    {
        return '{{%photos}}';
    }




}
