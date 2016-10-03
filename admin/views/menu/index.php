<?php
use common\libs\Yanphp;
?>


        <ul class="breadcrumb">
            <li class="current"><a href="">版块管理</a></li>
            <li><a href="?r=menu/add" class="J_dialog" title="添加菜单">添加菜单</a></li>
        </ul>

    <form class="J_ajaxForm" data-role="list" action="" method="post">


            <table id="J_table_list" class="table table-striped table-bordered">


                <tr>

                    <th><span class="mr5">[顺序]</span>菜单名称</th>
                    <th>别名</th>
                    <th>URL</th>
                    <th>显示</th>
                    <th>操作</th>
                </tr>

                <?php echo $menuTree?>


            </table>

        <div class="btn_wrap">
            <div class="btn_wrap_pd">
                <button type="submit" class="btn btn-default J_ajax_submit_btn">提交</button>
            </div>
        </div>
      </form>


