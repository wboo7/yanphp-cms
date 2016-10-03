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
 * This is the model class for table "{{%admin_action}}".
 *
 * @property string $id
 * @property string $name
 * @property string $route
 */
class AdminAction extends \yii\db\ActiveRecord
{
    public static $actions = null;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%admin_action}}';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'route'], 'required'],
            [['name'], 'string', 'max' => 30],
            [['route'], 'string', 'max' => 100],

            ['route', 'unique', 'targetClass' => '\common\models\AdminAction', 'message' => '路由已注册'],
        ];
    }



    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => Yii::t('app','Permission Name'),
            'route' => Yii::t('app','Route'),
        ];
    }


    public function getAction()
    {
        return $this->hasMany(AdminAction::className(),['role_id'=>'id']);
    }

    public function getAssignment()
    {
        return $this->hasMany(AdminAssignment::className(),['action_id'=>'id']);
    }

    public static function roleActions()
    {
        $key = 'permission_actions';
        if(self::$actions == null)
        {
            $session = Yii::$app->session;
            if(!$session->has($key))
            {
                $role_id = Yii::$app->user->identity->role_id;
                $action_ids = \common\models\AdminAssignment::find()
                    ->select('action_id')
                    ->asArray()
                    ->where(['role_id'=>$role_id])
                    ->column();

                $actions  = \common\models\AdminAction::find()
                    ->select('route')
                    ->asArray()
                    ->where(['in','id',$action_ids])
                    ->column();
                $session->set($key,$actions);
            }
            else
            {

                $actions = $session->get($key);

            }

            self::$actions = $actions;
        }
       return self::$actions;
    }

    public static function canAction($route)
    {
        $ignore = [
            'site/index',
            'site/get-recycle',
            'site/logout'
        ];
        if(in_array($route,$ignore))
            return true;
        if(Yii::$app->user->identity->username == 'admin')
            return true;
        $actions = self::roleActions();
        if(!$actions)
            return false;
        if(in_array($route,$actions))
            return true;
        else
            return false;
    }
}
