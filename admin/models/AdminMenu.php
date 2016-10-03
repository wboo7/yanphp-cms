<?php

namespace admin\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * ContactForm is the model behind the contact form.
 */
class AdminMenu extends ActiveRecord
{


    public static function tableName()
    {
        return '{{%admin_menu}}';
    }

    /*
     * 必须场景，不然load()不了值，就不能给数据库字段赋值
     * */
    public function scenarios()
    {
       return [
           'default' => ['name','alias','parentid','group','c','a','data','vieworder','display']
       ];
    }

    /*
     * rules方法要么没有，要么必须返回一个数组
     * */
    public function rules()
    {
        return [

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [

        ];
    }

    public function menuTree($parentid = 0, $step = '<span class="plus_icon plus_none_icon"></span>')
    {
        static $treehtml;
        $list = self::find()
            ->asArray()
            ->where(['parentid'=>$parentid])
            //->orderBy('id ASC')
            ->all();

        foreach ($list as $k=>$r)
        {
            $sublist = self::find()
                ->asArray()
                ->where(['parentid'=>$r['id']])
                ->all();

            $icon = !empty($sublist)? 'away_icon' : 'zero_icon';
            $tbodyid = ($parentid != 0)? 'id="J_table_list_'.$parentid.'"' : '';
            if ($parentid != 0)
            {
                $step2 = '<span class="plus_icon plus_end_icon"></span>';
                $span_icon = '';
            } else {
                $step2 = '';
                $span_icon = '<span data-id="'.$r['id'].'" class="J_start_icon '.$icon.'"></span>';
            }

            if ($r['display'] == 0) {
                $display = '<font color="red">隐藏</font>';
            } else {
                $display = '<font color="blue">显示</font>';
            }

            $treehtml .= '
					<tr id="J_forum_tr_'.$r['id'].'">
						<td>'.$step.$step2.'<input type="text" class="input mr5" name="vieworder['.$r['vieworder'].']" value="0" style="width:20px;"><span class="mr10 J_forum_names" data-id="1">'.$r['name'].'</span></td>
						<td>'.$r['alias'].'</td>
						<td>?r='.$r['c'].'/'.$r['a'].$r['data'].'</td>
						<td>'.$display.'</td>
						<td>
							<a href="?r=menu/edit&id='.$r['id'].'" class="mr5 J_dialog">[编辑]</a>
							<a href="?r=menu/delete&id='.$r['id'].'" class="mr5 J_ajax_del" data-pdata="{\'id\': \''.$r['id'].'\'}">[删除]</a>
						</td>
					</tr>';

            if (!empty($sublist))
            {
                $this->menuTree($r['id'], $step.'<span class="plus_icon plus_none_icon"></span>');
            }
        }

        return $treehtml;
    }

    /**
     * 菜单SELECT表单
     */
    public function menu_options($id = 0, $parentid = 0, $step = '')
    {
        static $string, $selected;
        $list = self::find()
            ->asArray()
            ->where(['parentid'=>$parentid])
            ->all();
        foreach ($list as $k=>$r)
        {
            $selected = ($id == $r['id'] && $id > 0)? 'selected' : '';

            if(($k+1) == count($list))
                $icon = '└─ ';
            else
                $icon = '├─ ';

            if ($parentid == 0)
            {
                $string .= '<option value="'.$r['id'].'" '.$selected.'>'.$r['name'].'</option>';
            } else {
                $string .= '<option value="'.$r['id'].'" '.$selected.'>'.$step.$icon.$r['name'].'</option>';
            }

            $subList = self::find()
                ->asArray()
                ->where(['parentid'=>6])
                ->all();
            if (!empty($subList))
            {
                $this->menu_options($id, $r['id'], $step.'&nbsp;&nbsp;&nbsp;&nbsp;');
            }
        }

        return $string;
    }

    public static function getAllMenus()
    {
        $subMenus = self::find()
            ->asArray()
            ->where(['parentid'=>0,'display'=>1])
            ->orderBy('vieworder ASC,id ASC')
            ->all();
        foreach ($subMenus as $r)
        {
            $menus[$r['alias']] = array(
                'id' => $r['alias'],
                'name' => $r['name'],
                'icon' => '',
                'tip' => '',
                'parent' => '',
                'top' => '',
            );

            $sublist = self::find()
                ->asArray()
                ->where(['parentid'=>$r['id'], 'display'=>1])
                ->orderBy('vieworder ASC,id ASC')
                ->all();
            if (!empty($sublist))
            {
                foreach ($sublist as $rs)
                {
//                    if(Yii::$app->user->can($rs['c'].'/'.$rs['a']) ||(Yii::$app->user->identity->id ==1 && preg_match('~^rbac|menu~',$rs['c'])))
                    if(true)
                    {
                        if (!empty($rs['group'])) {
                            $menus[$r['alias']]['items'][$rs['group']]['id'] = $rs['alias'];
                            $menus[$r['alias']]['items'][$rs['group']]['name'] = $rs['group'];
                            $menus[$r['alias']]['items'][$rs['group']]['group'] = 'group';
                            $menus[$r['alias']]['items'][$rs['group']]['icon'] = '';
                            //$menus[$r['alias']]['items'][$rs['group']]['tip'] = '';
                            $menus[$r['alias']]['items'][$rs['group']]['parent'] = $r['alias'];
                            //$menus[$r['alias']]['items'][$rs['group']]['top'] = '';
                            $menus[$r['alias']]['items'][$rs['group']]['items'][$rs['alias']] = array(
                                'id' => $rs['alias'],
                                'name' => $rs['name'],
                                'icon' => '',
                                'tip' => '',
                                'parent' => $r['alias'],
                                'top' => '',
                                'url' => '?r='.$rs['c'].'/'.$rs['a'].$rs['data']
                            );
                        } else {
                            $menus[$r['alias']]['items'][$rs['alias']] = array(
                                'id' => $rs['alias'],
                                'name' => $rs['name'],
                                'icon' => '',
                                'tip' => '',
                                'parent' => $r['alias'],
                                'top' => '',
                                'url' => '?r='.$rs['c'].'/'.$rs['a'].$rs['data']
                            );
                        }
                    }

                }
            }

        }
        foreach($menus as $k=>$v)
        {
            if(!isset($v['items']))
                unset($menus[$k]);
        }

        return $menus;
    }




}
