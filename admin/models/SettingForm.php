<?php
namespace admin\models;
use common\libs\Bridge;
use Yii;
use yii\base\Model;

class SettingForm extends Model
{

    static $lans = [
        'en'=>'英文',
        'zh-CN'=>'中文',
    ];
    public $language;

    function rules()
    {
        return [
            ['language','required']
        ];
    }

    public function attributeLabels()
    {
        return [
            'language'=>\Yii::t('app','Language'),
        ];
    }

    public function getLanguage()
    {
        $configFile = Bridge::getConfigFile();

        $configStr = file_get_contents($configFile);

        preg_match('~[\"\'].*?language.*?[\"\'].*?=>.*?[\"\'](.*?)[\"\']~s',$configStr,$matches);
        return $matches[1];
    }

    public function save()
    {
        $configFile = Bridge::getConfigFile();
        $configStr = file_get_contents($configFile);
        $configStr = preg_replace('~([\"\'].*?language.*?[\"\'].*?=>.*?[\"\'])(.*?)([\"\'])~','$1'.$this->language.'$3',$configStr);
        file_put_contents($configFile,$configStr);

    }
}
?>