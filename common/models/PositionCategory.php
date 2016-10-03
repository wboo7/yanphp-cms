<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%position_category}}".
 *
 * @property integer $id
 * @property string $name
 */
class PositionCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%position_category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'name' => Yii::t('app','Name'),
        ];
    }

    public function getContents()
    {
        return $this->hasMany(Position::className(),['pid'=>'id']);
    }
}
