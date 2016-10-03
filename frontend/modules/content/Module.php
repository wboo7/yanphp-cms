<?php

namespace frontend\modules\content;
use yii;
class Module extends \yii\base\Module
{
    public $controllerNamespace = 'frontend\modules\content\controllers';
    public $runtime;

    public function init()
    {
        $this->runtime = \Yii::getAlias('@frontend/modules/content/runtime');

        parent::init();

        // custom initialization code goes here
    }
}
