<?php
/**
 * @link http://www.yanphp.com/
 * @copyright Copyright (c) 2016 YANPHP Software LLC
 * @license http://www.yanphp.com/license/
 */
namespace admin\controllers;

use Yii;
use common\models\Form;
use yii\base\Exception;
use yii\bootstrap\Html;
use yii\data\ActiveDataProvider;
use admin\controllers\BackendController;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\db\Migration;
use yii\db\Query;
use admin\models\FieldForm;

/**
 * FormController implements the CRUD actions for Form model.
 */
class FormController extends BackendController
{


    /**
     * Lists all Form models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Form::find()->orderBy('id DESC'),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Form model.
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
     * Creates a new Form model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Form();
        $model->loadDefaultValues();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                $connection = Yii::$app->db;
                $transaction = $connection->beginTransaction();
                try {
                    $model->save();
                    $createSql = <<<eof
CREATE TABLE `{$model->table_name}` (
  `id` int(11) NOT NULL COMMENT 'ID',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `created_ip` char(20) NOT NULL COMMENT '提交ip',
  `status` tinyint(2) NOT NULL DEFAULT '1' COMMENT '状态'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='{$model->name}'
eof;

                    $connection->createCommand($createSql)->execute();

                    $modifySql = <<<eof
ALTER TABLE `{$model->table_name}`
  ADD PRIMARY KEY (`id`);
eof;
                    $connection->createCommand($modifySql)->execute();

                    $modifySql2 = <<<eof
ALTER TABLE `{$model->table_name}`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID';
eof;
                    $connection->createCommand($modifySql2)->execute();


                    $transaction->commit();
                } catch (Exception $e) {
                    $transaction->rollBack();
                }

                return $this->redirect(['index']);

            } else {

                return $this->renderError($model);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Form model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if (!$model->save()) {
                return $this->renderError($model);
            } else {
                return $this->redirect(['index']);
            }

        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Form model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {

        $model = $this->findModel($id);

        Yii::$app->db->createCommand("DROP TABLE IF EXISTS {$model->table_name}")->execute();
        $model->delete();

        return $this->jsonReturn([
            'title' => Yii::t('app','Tip'),
            'content' => Yii::t('app','Delete Success'),
            'refresh' => 'true'
        ]);
    }

    /**
     * Finds the Form model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Form the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Form::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionLists($table)
    {

        $query = (new Query())
            ->from($table);

        $totalCount = $query->count();
        $pages = new Pagination(['totalCount' => $totalCount]);
        $pages->setPageSize(15);

        $lists = $query
            ->select('*')
            ->all();
        $tableForm = Form::findOne(['table_name'=>$table]);

        //.结构
        $fields = Yii::$app->db->createCommand('SHOW full fields From ' . $table)->queryAll();

        return $this->render('lists', [
            'fields' => $fields,
            'lists' => $lists,
            'pages' => $pages,
            'tableForm'=>$tableForm
        ]);

    }

    //.添加或修改字段
    public function actionAdd($table)
    {
        $field = Yii::$app->request->get('field');
        $model = new FieldForm();
        if ($field) {
            $fields = Yii::$app->db->getTableSchema($table)->columns;
            $model->table = $table;
            $model->name = $field;
            $model->defaultValue = $fields[$field]->defaultValue;
            $model->type = preg_replace('/\(.*?\)/', '', $fields[$field]->dbType);
            $model->comment = $fields[$field]->comment;
            $model->length = $fields[$field]->size;

        }
        if ($post = Yii::$app->request->post()) {
            $model->load($post);
            $model->table = $table;
            if ($model->validate()) {
                $operator = $field ? 'MODIFY' : 'ADD';
                switch ($model->type) {
                    case 'varchar':
                        $length = max(intval($model->length), 10);
                        $defaultValue = $model->defaultValue;

                        $sql = "ALTER TABLE `{$table}` {$operator} `{$model->name}` VARCHAR( $length ) NOT NULL DEFAULT '{$defaultValue}' COMMENT '{$model->comment}'";
                        break;
                    case 'text':
                        $sql = "ALTER TABLE `$table` {$operator} `{$model->name}` TEXT NOT NULL COMMENT '{$model->comment}'";
                        break;

                }
                Yii::$app->db->createCommand($sql)->execute();
                return $this->redirect(['manage', 'table' => $table]);
            } else {
                return $this->renderError($model);
            }

        }
        return $this->render('add', ['model' => $model, 'table' => $table]);
    }

    //.字段管理
    public function actionManage($table)
    {
        $schema = Yii::$app->db->getTableSchema($table);

        return $this->render('manage', ['fields' => $schema->columns]);
    }

    //.字段删除
    public function actionFieldDelete($table, $field)
    {
        if(in_array($field,Form::$defaultFields))
        {
            return $this->jsonReturn([
                'title' => Yii::t('app','Tip'),
                'content' =>Yii::t('app','Can Not Delete Or Update The Default Field'),
                'footer'=>Html::button('关闭',['class'=>'btn btn-default','data-dismiss'=>'modal'])
            ]);
        }
        Yii::$app->db->createCommand("ALTER TABLE {$table} DROP COLUMN {$field}")->execute();
        return $this->jsonReturn([
            'title' => Yii::t('app','Tip'),
            'content' => Yii::t('app','Delete Success'),
            'refresh' => 'true'
        ]);
    }

    //.数据删除
    public function actionItemDelete($table, $id)
    {
        Yii::$app->db->createCommand()->delete($table, ['id' => $id])->execute();
        return $this->jsonReturn([
            'title' => Yii::t('app','Tip'),
            'content' => Yii::t('app','Delete Success'),
            'refresh' => 'true'
        ]);
    }

    //.数据修改
    public function actionItemUpdate($table, $id)
    {

        $data = Yii::$app->db->createCommand("SELECT * FROM `{$table}` WHERE `id` ={$id}")->queryOne();
        $data['created_at'] = date('Y/m/d H:i', $data['created_at']);
        $data['updated_at'] = date('Y/m/d H:i', $data['updated_at']);
        $columns = Yii::$app->db->getTableSchema($table)->columns;

        if ($post = Yii::$app->request->post()){
            $post['created_at'] = strtotime($post['created_at']);
            $post['updated_at'] = strtotime($post['updated_at']);
            Yii::$app->db->createCommand()->update($table, $post, ['id' => $id])->execute();
            return $this->redirect(['form/lists','table'=>$table]);
        }

        return $this->render('item-form', ['data' => $data, 'columns' => $columns]);
    }
}
