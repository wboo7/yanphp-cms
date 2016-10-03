<?php
namespace common\models;

use yii\base\Model;
use yii\web\UploadedFile;

/**
 * UploadForm is the model behind the upload form.
 */
class UploadForm extends Model
{
    /**
     * @var UploadedFile|Null file attribute
     */
    public $file;
    public $file_node;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            ['file', 'file','mimeTypes'=>'image/jpeg,image/jpg,image/png,image/gif','maxSize'=>2*1024*1024,'tooBig'=>'图片不能超过2M'],
            ['file_node','file','mimeTypes'=>['application/zip'],'maxSize'=>10*1024*1024,'tooBig'=>'压缩包不能超过10M','wrongMimeType'=>'请上传.zip压缩包'],

        ];
    }
    public function scenarios()
    {
        return [
            'manageImage'=>['file'],
            'image'=>['file'],
            'node'=>['file_node'],

        ];
    }
}