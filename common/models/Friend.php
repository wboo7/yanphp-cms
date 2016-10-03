<?php
/**
 * @link http://www.yanphp.com/
 * @copyright Copyright (c) 2016 YANPHP Software LLC
 * @license http://www.yanphp.com/license/
 */
namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%friend}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $filepath
 * @property integer $listorder
 * @property integer $status
 * @property string $link
 */
class Friend extends \yii\db\ActiveRecord
{
    public  $file;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%friend}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'filepath'], 'required'],
            [['listorder', 'status'], 'integer'],
            [['title', 'filepath', 'link'], 'string', 'max' => 100],
        ];
    }



    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => Yii::t('app','Title'),
            'filepath' => Yii::t('app','Path'),
            'listorder' => Yii::t('app','Sort'),
            'status' => Yii::t('app','Open'),
            'link' => Yii::t('app','Link'),
            'file'=>Yii::t('app','Image Upload')
        ];
    }
}
