<?php
/**
 * @link http://www.yanphp.com/
 * @copyright Copyright (c) 2016 YANPHP Software LLC
 * @license http://www.yanphp.com/license/
 */
namespace admin\controllers;

use common\helpers\File;
use common\libs\Bridge;
use common\models\UploadForm;
use Yii;
use common\models\Banner;
use yii\data\ActiveDataProvider;
use admin\controllers\BackendController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * BannerController implements the CRUD actions for Banner model.
 */
class BannerController extends BackendController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Banner models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Banner::find()->orderBy('id DESC'),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Banner model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Banner model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Banner();
        $model->loadDefaultValues();

        if ($model->load(Yii::$app->request->post())) {
            $this->upload($model);
            if($model->hasErrors())
            {
                return $this->renderError($model);
            }
            if(!$model->save())
            {
                return $this->renderError($model);
            }
            else
            {
                return $this->redirect(['index']);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    protected function upload($model)
    {
        $uploadModel = new UploadForm();
        $uploadModel->setScenario('image');
        $uploadModel->file = UploadedFile::getInstance($model,'file');
        if($uploadModel->file)
        {
            if($uploadModel->validate())
            {
                $extention = $uploadModel->file->getExtension();
                $uploadRoot = Bridge::getRootPath();
                $filename = uniqid().'.'.$extention;
                $savepath = $uploadRoot.'uploads/banner/';
                File::createDirectory($savepath);
                if($uploadModel->file->saveAs($savepath.$filename))
                {
                    $model->filepath = $filename;
                }
                else
                {
                    $model->setError('file',Yii::t('app','Upload Fail'));
                }
            }
            else
            {
                $model->setError('file',$uploadModel->getErrors('file'));
            }
        }



    }

    /**
     * Updates an existing Banner model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $this->upload($model);
            if($model->hasErrors())
            {
                return $this->renderError($model);
            }
            if(!$model->save())
            {
                return $this->renderError($model);
            }
            else
            {
                return $this->redirect(['index']);
            }

        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Banner model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Banner model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Banner the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Banner::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
