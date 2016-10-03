<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;


/**
 * Admin model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class Admin extends ActiveRecord implements IdentityInterface
{

    public $password;
    public $re_password;
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%admin}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],

            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required','message'=>'用户名不能为空'],
            ['username', 'unique', 'targetClass' => '\common\models\Admin', 'message' => '用户名已注册'],
            ['username', 'string', 'min' => 2, 'max' => 20,'tooShort'=>'推荐使用英文名称，可以使用2-20位字符，数字，英文，下划线组合','tooLong'=>'推荐使用英文名称，可以使用2-20位字符，数字，英文，下划线组合'],

            ['role_id','integer'],

            ['password', 'string', 'min' => 6,'message'=>'密码最小长度6位'],

            ['re_password', 'string', 'min' => 6,'message'=>'密码最小长度6位'],
            ['re_password', 'compare', 'compareAttribute'=>'password','message'=>'两次密码不一致'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id'=>'ID',
            'role_id'=>Yii::t('app','Role'),
            'username'=>Yii::t('app','User Name'),
            'logindate'=>Yii::t('app','Login Date'),
            'loginip'=>Yii::t('app','Login Ip'),
            'password'=>Yii::t('app','Password'),
            're_password'=>Yii::t('app','Re Password')
        ];
    }
    public function beforeValidate()
    {
        if($this->isNewRecord)
        {
            if($this->password == '' || $this->re_password == '')
            {
                $this->addError('password','密码不能为空');
                return false;
            }
        }
        $valid = parent::beforeValidate();
        if($valid)
        {
            $this->setPassword($this->password);
        }
        return $valid;
    }

    public function getRole()
    {
        return $this->hasOne(AdminRole::className(),['id'=>'role_id']);
    }

    /**
     * @inheritdoc
     * 根据指定的用户ID查找 认证模型类的实例，当你需要使用session来维持登录状态的时候会用到这个方法
     */
    public static function findIdentity($id)
    {

        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {

        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {

        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }
    public static function getPasswordHash($password)
    {
        return Yii::$app->security->generatePasswordHash($password);;
    }
    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /*
     * 获取用户信息
     * */
    public static  function findModel()
    {
        $id = Yii::$app->user->identity->id;
        $model = self::findOne($id);
        return $model;

    }



    /* 获取角色 */
    public function getAdminRole()
    {
        return $this->hasOne(\common\models\AdminRole::className(), ['id' => 'roleid']);
    }


}
