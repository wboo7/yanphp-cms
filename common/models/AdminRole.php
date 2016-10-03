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
 * This is the model class for table "{{%admin_role}}".
 *
 * @property string $id
 * @property string $name
 */
class AdminRole extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%admin_role}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','description'], 'required'],
            [['name'], 'string', 'max' => 20],
            [['description'], 'string', 'max' => 100],
        ];
    }




    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => Yii::t('app','Role Name'),
            'description' => Yii::t('app','Description'),

        ];
    }

    public function getAdmin()
    {
        return $this->hasMany(Admin::className(),['role_id'=>'id']);
    }

    public function getAssignment()
    {
        return $this->hasMany(AdminAssignment::className(),['role_id'=>'id']);
    }
}
