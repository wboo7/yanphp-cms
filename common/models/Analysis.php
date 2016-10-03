<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%analysis}}".
 *
 * @property integer $id
 * @property string $url
 * @property string $ua
 * @property string $ip
 * @property integer $created_at
 */
class Analysis extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%analysis}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url', 'ua', 'ip'], 'required'],
            [['created_at'], 'integer'],
            [['url'], 'string', 'max' => 255],
            [['ua'], 'string', 'max' => 255],
            [['ip'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => '访问路劲',
            'ua' => '访问设备',
            'ip' => 'ip地址',
            'created_at' => '访问时间',
        ];
    }
}
