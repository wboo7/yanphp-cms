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
 * This is the model class for table "{{%form}}".
 *
 * @property integer $id
 * @property string $table_name
 * @property string $name
 * @property string $description
 * @property integer $created_at
 * @property integer $updated_at
 */
class Form extends \yii\db\ActiveRecord
{
    static $defaultFields = [
        'id',
        'created_at',
        'updated_at',
        'created_ip',
        'status'
    ];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%form}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['table_name', 'name', 'description'], 'required'],
            ['table_name', 'unique', 'targetClass' => '\common\models\Form', 'message' => '表名重复'],
            ['name', 'unique', 'targetClass' => '\common\models\Form', 'message' => '表单名称重复'],
            [['created_at', 'updated_at','status'], 'integer'],
            [['table_name', 'name'], 'string', 'max' => 30],
            ['table_name', 'match','pattern'=>'/^yan_form_\w+/','message'=>'请输入以yan_form_开头命名的英文字符串'],
            [['description'], 'string', 'max' => 150],
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'table_name' => '表名',
            'name' => '表单名称',
            'description' => '表单描述',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
            'status'=>'状态'
        ];
    }
}
