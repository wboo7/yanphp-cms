<?php
namespace admin\models;
use yii\base\Model;

class PasswordForm extends Model
{
    public $password;
    public $repassword;

    function rules()
    {
        return [
            [['password', 'repassword'], 'required'],
            [['password', 'repassword'], 'string', 'min' => 6, 'max' => 16],

            ['repassword', 'compare', 'compareAttribute' => 'password', 'message' => \Yii::t('app','Password Is Not The Same')]
        ];
    }

    public function attributeLabels()
    {
        return [
            'password'=>\Yii::t('app','Password'),
            'repassword'=>\Yii::t('app','Re Password')
        ];
    }
}
?>