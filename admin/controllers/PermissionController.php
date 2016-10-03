<?php
/**
* @link http://www.yanphp.com/
* @copyright Copyright (c) 2016 YANPHP Software LLC
* @license http://www.yanphp.com/license/
*/
namespace admin\controllers;

use common\models\AdminAssignment;
use Yii;
use common\models\AdminRole;
use common\models\AdminAction;
use common\models\Admin;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class PermissionController extends BackendController
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

    //.admin
    public function actionAdmin()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Admin::find()->orderBy('id DESC'),
        ]);

        return $this->render('admin', [
            'dataProvider' => $dataProvider,
        ]);
    }
    //.管理员添加、更新
    public function actionAdminCreate()
    {
        $id = Yii::$app->request->get('id');
        if($id)
        {
            $model = Admin::findOne($id);
        }
        else
        {
            $model = new Admin();
        }

        if($post = Yii::$app->request->post())
        {
            $model->load($post);
            if($model->save())
            {
                return $this->redirect(['admin']);
            }
            else
            {
                return $this->renderError($model);
            }

        }
        return $this->render('admin-form',['model'=>$model]);
    }

    public function actionDeleteAdmin($id)
    {
        $model = Admin::findOne($id);
        if(!$model)
            return;
        $model->delete();
        return $this->redirect(['admin']);
    }

    //.角色列表
    public function actionIndex()
    {

        $dataProvider = new ActiveDataProvider([
            'query' => AdminRole::find()->orderBy('id DESC'),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AdminRole model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AdminRole model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AdminRole();
        $model->loadDefaultValues();

        if ($model->load(Yii::$app->request->post())) {

            if(!$model->save())
            {
                return $this->renderError($model);
            }
            else
            {
                $this->assignment($model);
                return $this->redirect(['index']);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AdminRole model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {


            if(!$model->save())
            {
               return $this->renderError($model);
            }
            else
            {
                $this->assignment($model);
                return $this->redirect(['index']);
            }

        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    protected function assignment($model)
    {
        $assignment = Yii::$app->request->post()['AdminRole']['assignment'];
        AdminAssignment::deleteAll(['role_id'=>$model->id]);
        if($assignment)
        {
            foreach($assignment as $v)
            {
                $aModel = new AdminAssignment();
                $aModel->role_id = $model->id;
                $aModel->action_id = $v;
                $aModel->save(false);
            }
        }

    }


    /**
     * Deletes an existing AdminRole model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if($model->admin)
        {
            return $this->renderError('该角色下存在管理员，不能删除！',true);
        }
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AdminRole model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return AdminRole the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AdminRole::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /*=============================== action ================================*/
    public function actionAction()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => AdminAction::find()->orderBy('name DESC'),
        ]);

        return $this->render('action', [
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionCreateAction()
    {
        $id = Yii::$app->request->get('id');
        if($id)
        {
            $model = AdminAction::findOne($id);
        }
        else
        {
            $model = new AdminAction();
            $model->loadDefaultValues();
        }

        if ($model->load(Yii::$app->request->post())) {
            if(!$model->save())
            {
                return $this->renderError($model);
            }
            else
            {
                return $this->redirect(['action']);
            }
        } else {
            return $this->render('action-form', [
                'model' => $model,
            ]);
        }
    }

    public function actionDeleteAction($id)
    {
        $model = AdminAction::findOne($id);
        if(!$model)
            return;
        AdminAssignment::deleteAll(['action_id'=>$id]);
        $model->delete();
        return $this->redirect(['action']);
    }
}
