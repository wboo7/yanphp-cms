<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%msg}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $gender
 * @property string $qq
 * @property string $email
 * @property string $mobile
 * @property integer $create_time
 * @property string $create_ip
 * @property string $content
 */
class Msg extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%msg}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
//        return [
//            [['name', 'qq', 'email', 'mobile', 'create_time', 'create_ip', 'content'], 'required'],
//            [['gender', 'create_time'], 'integer'],
//            [['content'], 'string'],
//            [['name', 'qq', 'create_ip'], 'string', 'max' => 20],
//            [['email'], 'string', 'max' => 100],
//            [['mobile'], 'string', 'max' => 14],
//        ];
        return [];
    }

    public function scenarios()
    {
        return [
            'default'=>$this->attributes()
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '姓名',
            'gender' => '性别',
            'qq' => 'QQ',
            'email' => '邮箱',
            'mobile' => '手机',
            'create_time' => '留言时间',
            'create_ip' => '留言ip',
            'content' => '留言内容',
        ];
    }
}
