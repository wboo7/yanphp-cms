<?php
namespace common\libs;
use common\models\Model;
use yii\helpers\Url;
use yii\helpers\Html;

/**
 * 通用的树型类，可以生成任何树型结构
 */
class tree
{
    /**
     * 生成树型结构所需要的2维数组
     * @var array
     */
    public $arr = array();

    /**
     * 生成树型结构所需修饰符号，可以换成图片
     * @var array
     */
    public $icon = array('│', '├', '└');
    public $nbsp = "&nbsp;";

    /**
     * @access private
     */
    public $ret = '';


    public function init($arr = array())
    {
        $this->arr = $arr;
        $this->ret = '';
        return is_array($arr);
    }

    public function get_tree()
    {
        $category = $this->arr;
        $top = [];
        foreach ($category as $v) {
            if ($v['parentid'] == 0) {
                $top[] = $v;
            }
        }
        $str = '<ul id="browser" class="filetree">';

        foreach ($top as $v) {
            if (!empty($v['sub'])) {
                $str .= '<li><span class="folder" title="catid:'.$v['id'].'">' . $v['catname'] . '</span>';
                $len = count($v['sub']);
                $str .= '<ul>';
                for ($i = 0; $i < $len; $i++) {
                    $a = $v['sub'][$i]['model']['type'] == Model::TYPE_CUSTOM ? 'add' : 'file';
                    $b = 'id="' . $v['sub'][$i]['id'] . '"';
                    $ispage = $v['model']['type'] == Model::TYPE_PAGE ? 'ispage="true"' : '';
                    $str .= '<li '.$ispage.' '. $b . '><span class="' . $a . '" title="catid:'.$v['sub'][$i]['id'].'">' . '<a href="?r=content/index&catid='.$v['sub'][$i]['id'].'" class="pjax-link">'.$v['sub'][$i]['catname'] . '</a></span></li>';
                }
                $str .= '</ul>';

            } else {
                $str .= '<li id="' . $v['id'] . '"><span class="add" title="catid:'.$v['id'].'">' .'<a href="?r=content/index&catid='.$v['id'].'">'. $v['catname'] . '</a></span>';
            }
            $str .= '</li>';
        }
        $str .= '</ul>';

        return $str;

    }

    /*
     * 先初始化字段，再格式化层级显示
     * */
    public function get_tree_lists($parentid = 0,$adds='')
    {

        $categorys = $this->arr;
        $childs = $this->get_child($parentid);
        /* 格式化 */

        if(!empty($childs))
        {
            $num = 1;
            $total = count($childs);
            foreach($childs as $k=>$v)
            {

                $j=$k='';
                if($num==$total){
                    $j .= $this->icon[2];
                }else{
                    $j .= $this->icon[1];
                    $k = $adds ? $this->icon[0] : '';
                }
                $parentid == 0 && $spacer = '';
                $spacer = $adds ? $adds.$j:'';


                $str = '<tr>';
                $str .= '<td align="center"><a href="'.Url::to(['category-content/sort','id'=>$v['id'],'act'=>'down']).'" class=" fa fa-long-arrow-down"></a> <a href="'.Url::to(['category-content/sort','id'=>$v['id'],'act'=>'up']).'" class=" fa fa-long-arrow-up"></a></td>';
                // $str .= '<td align="center">'.$v['listorder'].'</td>';
                $str .= '<td align="center">'.$v['id'].'</td>';
                $str .= '<td>'.$spacer.$v['catname'].'</td>';
                $str .= '<td align="center">'.$v['modelname'].'</td>';
                $str .= '<td align="center">'.($v['model']['list_template']?$v['model']['list_template']:'--').'</td>';
                $str .= '<td align="center">'.($v['model']['show_template']?$v['model']['show_template']:'--').'</td>';
                $str .= '<td align="center">'.($v['ismenu']? '是' : '否').'</td>';

                $str .= '<td align="center">'.$v['str_manage'].'</td>';
                $str .= '</tr>';

                $this->ret .= $str;
                $this->get_tree_lists($v['id'],$adds.$this->nbsp);
                $num ++;
            }

        }
        return $this->ret;

    }


    /**
     * 得到子级数组
     * @param int
     * @return array
     */
    public function get_child($myid)
    {
        $a = $newarr = array();
        if (is_array($this->arr)) {
            foreach ($this->arr as $id => $a) {
                if ($a['parentid'] == $myid) $newarr[$id] = $a;
            }
        }
        return $newarr ? $newarr : false;
    }

    /*
     * 简单格式化分类层级
     * $parentid 父id
     * $sid 当前id
     * */
    public function get_tree_simple($parentid=0,$adds='')
    {
        $this->nbsp = '  ';
        static $ret;
        $categorys = $this->arr;
        $childs = $this->get_child($parentid);
        /* 格式化 */

        if(!empty($childs))
        {
            $num = 1;
            $total = count($childs);
            foreach($childs as $k=>$v)
            {
                $j=$k='';
                if($num==$total){
                    $j .= $this->icon[2];
                }else{
                    $j .= $this->icon[1];
                }
                $parentid == 0 && $spacer = '';
                $spacer = $adds ? $adds.$j:'';
                $v['format_name'] = $spacer.$v['catname'];

                $ret[] = $v;
                $this->get_tree_simple($v['id'],$adds.$this->nbsp);
                $num ++;
            }
        }
        return $ret;

    }

}
