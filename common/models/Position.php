<?php
namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%position}}".
 *
 * @property string $id
 * @property string $pid
 * @property string $contentid
 * @property string $catid
 * @property integer $listorder
 * @property integer $status
 */
class Position extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%position}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['contentid','pid','catid'], 'required'],
            [['contentid', 'catid', 'listorder', 'status','pid'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'pid' => '推荐位分类',
            'contentid' => '内容ID',
            'catid' => '所属分类',
            'listorder' => '排序',
            'status' => '开启状态',
        ];
    }

    public function getCategoryContent()
    {
        return $this->hasOne(CategoryContent::className(),['id'=>'catid']);
    }
    public function getCategory()
    {
        return $this->hasOne(PositionCategory::className(),['id'=>'pid']);
    }
    public function getContent()
    {
        return $this->hasOne(Content::className(),['id'=>'contentid']);
    }

}
