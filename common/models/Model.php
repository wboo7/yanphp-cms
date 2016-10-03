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
class Model extends ActiveRecord
{


    const TYPE_CUSTOM = 0;
    const TYPE_PAGE = 1;

    public static function tableName()
    {
        return '{{%model}}';
    }

    public function rules()
    {
        return [
            [['name','description','list_template','show_template'],'trim'],
            [['name','description','tablename','show_template'],'required'],
            ['type','integer'],
            ['name', 'unique', 'targetClass' => '\common\models\Model', 'message' => '模型名重复'],
            ['list_template', 'unique', 'targetClass' => '\common\models\Model', 'message' => '栏目列表页模板重复'],
            ['show_template', 'unique', 'targetClass' => '\common\models\Model', 'message' => '栏目展示页模板重复'],

        ];
    }

    public function attributeLabels()
    {
        return [
            'pid'=>'克隆模型',
            'name'=>Yii::t('app','Model Name'),
            'description'=>Yii::t('app','Model Description'),
            'list_template'=>Yii::t('app','Category List Template'),
            'show_template'=>Yii::t('app','Category Show Template'),
            'type'=>Yii::t('app','Type'),
        ];
    }

    public function beforeValidate()
    {

        if($this->list_template)
        {
            if(!preg_match('~^[a-z_0-9]+$~',$this->list_template))
                $this->addError('list_template', '名称包含不规范的字符，只能a-z或下划线');
            if(substr($this->list_template,0,5) != 'list_')
                $this->addError('list_template', '栏目列表页命名不规范，正确的为"list_xxx"!');
        }

        if($this->show_template)
        {

            if(!preg_match('~^[a-z_0-9]+$~',$this->show_template))
                $this->addError('show_template', '名称包含不规范的字符，只能a-z或下划线');
            if(substr($this->show_template,0,5) != 'show_')
                $this->addError('show_template', '栏目展示页命名不规范，正确的为"show_xxx"!');
        }


        if($this->hasErrors())
            return false;
        else
            return parent::beforeValidate();
    }

    public static function getInfo($modelid)
    {
        $info = self::find()
            ->where('id='.$modelid)
            ->asArray()
            ->one();
        return $info;
    }
    public static function getAll()
    {
        $lists = self::find()
            ->asArray()
            ->all();
        return $lists;
    }
    public function getCategory()
    {
        return $this->hasMany(CategoryContent::className(),['modelid'=>'id']);
    }

}
