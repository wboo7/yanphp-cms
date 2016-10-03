<?php


namespace common\widgets\CategoryContent;
use common\models\CategoryContent;
use common\libs\Tree;
class Category extends \yii\bootstrap\Widget
{
   public $container;

    public function init()
    {
        parent::init();


    }
    public function run()
    {

        $model = new CategoryContent();
        $categorys = $model->getListsChilds();

        $tree = new tree();
        $tree->icon = array('&nbsp;&nbsp;&nbsp;│ ', '&nbsp;&nbsp;&nbsp;├─ ', '&nbsp;&nbsp;&nbsp;└─ ');
        $tree->nbsp = '&nbsp;&nbsp;&nbsp;';
        $tree->init($categorys);
        $categorys = $tree->get_tree();

        $str = <<<EOF
<script>
        $(document).ready(function(){
            $("{$this->container}").treeview();

        });
    </script>
EOF;


        $view = $this->getView();
        CategoryAsset::register($view);

        return $categorys.$str;
    }
}
