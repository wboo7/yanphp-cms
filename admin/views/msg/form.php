<?php

?>
<ul class="breadcrumb">
    <li class="current"><a href="?r=msg/index">留言列表</a></li>
    <li><a href="?r=msg/form">管理表单</a></li>

</ul>
<div class="row">
    <div class="col-md-12">
        <div class="y_panel">
            <div class="y_title"> 字段信息</div>
            <div class="y_content">
                <table class="table">
                    <tr>
                        <th>注释 <span class="glyphicon glyphicon-question-sign dpsblue pointer f14"  data-toggle="popover" title="注释" data-content="前台留言板单项的名称"></span></th>
                        <th>标识<span class="glyphicon glyphicon-question-sign dpsblue pointer f14"  data-toggle="popover" title="标识" data-content="数据表的字段名称，必须为英文"></span></th>
                        <th>类型<span class="glyphicon glyphicon-question-sign dpsblue pointer f14"  data-toggle="popover" title="类型" data-content="表的字段类型，根据长度自动生成"></span></th>

                        <th>操作</th>

                    </tr>

                    <?php foreach($fields as $v):?>
                        <tr>
                            <td><?= $v['Comment']?></td>
                            <td><?= $v['Field']?></td>
                            <td><?= $v['Type']?></td>

                            <td>
                                <?php if($v['Field'] == 'id' || $v['Field'] == 'content' || $v['Field'] == 'create_time' || $v['Field'] == 'create_ip'){
                                    echo '<span title="禁止删除" class="glyphicon glyphicon-minus"></span>';
                                }else{
                                    echo '<a role="modal-remote" data-confirm-title="删除" data-confirm-message="确定删除吗？" data-url="?r=msg/drop&field='.$v['Field'].'"  class="fa fa-trash"></a>';
                                }?>
                            </td>

                        </tr>
                    <?php endforeach;?>


                </table>
                <span role="modal-remote" title="添加字段" data-url="?r=msg/create" class=" glyphicon glyphicon-plus org  J_dialog f24" style="font-weight: 800;"></span>

            </div>
        </div>
    </div>
</div>

<script src="<?= Yii::getAlias('@web/').'statics/common/js/bootstrap.js'?>"></script>

<script>
    $(function () {
        $('[data-toggle="popover"]').popover({trigger:'hover'});

    })
</script>
