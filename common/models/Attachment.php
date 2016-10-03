<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%attachment}}".
 *
 * @property string $id
 * @property string $module
 * @property integer $catid
 * @property string $filename
 * @property string $filepath
 * @property string $filesize
 * @property string $fileext
 * @property integer $isimage
 * @property integer $isthumb
 * @property string $downloads
 * @property string $userid
 * @property string $uploadtime
 * @property string $uploadip
 * @property integer $status
 * @property string $authcode
 */
class Attachment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%attachment}}';
    }

    public function scenarios()
    {
        return  [
            'default'=>$this->attributes()
        ];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['module', 'filename', 'filepath', 'fileext', 'uploadip', 'authcode'], 'required'],
            [['catid', 'filesize', 'isimage', 'isthumb', 'downloads', 'userid', 'uploadtime', 'status'], 'integer'],
            [['module', 'uploadip'], 'string', 'max' => 15],
            [['filename'], 'string', 'max' => 50],
            [['filepath'], 'string', 'max' => 200],
            [['fileext'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'module' => 'Module',
            'catid' => 'Catid',
            'filename' => 'Filename',
            'filepath' => 'Filepath',
            'filesize' => 'Filesize',
            'fileext' => 'Fileext',
            'isimage' => 'Isimage',
            'isthumb' => 'Isthumb',
            'downloads' => 'Downloads',
            'userid' => 'Userid',
            'uploadtime' => 'Uploadtime',
            'uploadip' => 'Uploadip',
            'status' => 'Status',
            'authcode' => 'Authcode',
        ];
    }

    public function getCategoryContent()
    {
        return $this->hasOne(\common\models\CategoryContent::className(), ['catid' => 'catid']);
    }
}
