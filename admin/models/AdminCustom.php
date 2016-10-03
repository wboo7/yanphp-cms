<?php

namespace admin\models;

use Yii;
use yii\db\ActiveRecord;


class AdminCustom extends ActiveRecord
{

    public static function tableName()
    {
        return '{{%admin_custom}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [

        ];
    }


}
