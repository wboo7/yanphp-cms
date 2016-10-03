<?php
namespace admin\controllers;

use Yii;
use yii\filters\AccessControl;
use admin\controllers\BackendController;
use admin\models\AdminMenu;


class MenuController extends BackendController
{

    public function actionIndex()
    {

        $menuMod = new AdminMenu();
        $menuTree = $menuMod->menuTree();

        return $this->render('index',[
            'menuTree'=>$menuTree
        ]);
    }

    public function actionAdd()
    {
        $menuMod = new AdminMenu();
        if ($postDatas = Yii::$app->request->post())
        {
            $menuMod->load($postDatas);
            $result = $menuMod->load($postDatas) && $menuMod->validate() && $menuMod->save();
            if ($result)
                $this->ajaxReturn('success', '添加成功', '?r=menu');
            else
                $this->ajaxReturn('fail', '添加失败');
        }
        else
        {
            $menu_options = $menuMod->menu_options();
            return $this->render('form',[
                'model' => $menuMod,
                'menu_options' => $menu_options
            ]);
        }

    }
    public function actionEdit($id)
    {

        $menuMod = AdminMenu::findOne($id);
        if ($postDatas = Yii::$app->request->post())
        {
            $menuMod->load($postDatas);
            $result = $menuMod->load($postDatas) && $menuMod->validate() && $menuMod->save();
            if ($result)
                $this->ajaxReturn('success', '添加成功', '?r=menu');
            else
                $this->ajaxReturn('fail', '添加失败');
        }
        else
        {
            $info = $menuMod
                ->find()
                ->asArray()
                ->where(['id'=>$id])
                ->one();
            $menu_options = $menuMod->menu_options($info['parentid']);
            return $this->render('form',[
                'model' => $menuMod,
                'info' => $info,
                'menu_options' => $menu_options
            ]);
        }
    }

    public function actionDelete($id)
    {

        $menuMod = AdminMenu::findOne($id);

        if($menuMod != null &&  $menuMod->delete())
        {
            $this->ajaxReturn('success', '删除成功', '?r=menu');
        }
        else
        {
            $this->ajaxReturn('fail', '删除失败');

        }
    }


}
