<?php
namespace frontend\modules\content\controllers;
use Yii;
use common\helpers\File;
use common\libs\Bridge;
use yii\web\Controller;


class PublicController extends Controller
{
    public $enableCsrfValidation = false;


    public function actions()
    {
        return [
            'image-upload-content' => [
                'class' => 'vova07\imperavi\actions\UploadAction',
                'url' => Bridge::getRootUrl().'uploads/content-editor',
                'path' => Bridge::getRootPath().'uploads/content-editor',
                'resize'=>false
            ],

        ];
    }





}
