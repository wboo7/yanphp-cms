

<?php
$todayTimestamp = strtotime(date('Y-m-d'));

$todayMsg = Yii::$app->db->createCommand("SELECT COUNT(*) FROM `yan_form_msg` WHERE `created_at`>{$todayTimestamp}")->queryScalar();
$totalContent = \common\models\Content::find()
    ->count();

$totalClick = \common\models\Content::find()
    ->select('SUM(click)')
    ->scalar();


?>
<div class="row top_tiles">
    <div class=" col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
            <div class="icon"><i class="fa fa-list-ul"></i></div>
            <div class="count"><?=$totalContent?></div>
            <h3><?=Yii::t('app','Total Content')?></h3>
            <p><?=Yii::t('app','More content more search engine hold')?></p>
        </div>
    </div>
    <div class=" col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
            <div class="icon"><i class="fa fa-eye"></i></div>
            <div class="count"><?=$totalClick?$totalClick:0?></div>

            <h3><?=Yii::t('app','History Click')?></h3>
            <p><?=Yii::t('app','The number of historical content clicks')?></p>
        </div>
    </div>
    <div class=" col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
            <div class="icon"><i class="fa fa-comment-o"></i></div>
            <div class="count"><?=$todayMsg?></div>
            <h3><?=Yii::t('app','Today Msg')?></h3>
            <p><?=Yii::t('app','The number of today message')?></p>
        </div>
    </div>
    <div class=" col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="tile-stats">
            <div class="icon"><i class="fa fa-recycle"></i></div>
            <div class="count"><span id="recycleTotal">--</span></div>
            <h3><?=Yii::t('app','Rubbish Files')?></h3>
            <p id="recycleTxt"><?=Yii::t('app','Clean up unused make the system cleaner')?></p>
        </div>
    </div>
</div>

<?php
/**
 * 获取系统信息
 */
function get_sysinfo() {
    $sys_info['os']             = PHP_OS;
    $sys_info['zlib']           = function_exists('gzclose');//zlib
    $sys_info['safe_mode']      = (boolean) ini_get('safe_mode');//safe_mode = Off
    $sys_info['safe_mode_gid']  = (boolean) ini_get('safe_mode_gid');//safe_mode_gid = Off
    $sys_info['timezone']       = function_exists("date_default_timezone_get") ? date_default_timezone_get() : L('no_setting');
    $sys_info['socket']         = function_exists('fsockopen') ;
    $sys_info['web_server']     = strpos($_SERVER['SERVER_SOFTWARE'], 'PHP')===false ? $_SERVER['SERVER_SOFTWARE'].'PHP/'.phpversion() : $_SERVER['SERVER_SOFTWARE'];
    $sys_info['phpv']           = phpversion();
    $sys_info['fileupload']     = @ini_get('file_uploads') ? ini_get('upload_max_filesize') :'unknown';
    return $sys_info;
}
$sysInfo = get_sysinfo();

?>
<style>
    .sysinfo strong{width:100px;display: inline-block;}
    .sysinfo a{color: #666;}

</style>
<div class="row">
    <div class="col-md-12">
        <div class="y_panel">
            <div class="y_title"><?=Yii::t('app','System Info')?></div>
            <div class="y_content sysinfo">
                <h5><strong><?=Yii::t('app','Soft Name')?></strong><span><a target="_blank" href="http://www.yanphp.com">Yanphp</a> <?=Yii::t('app','Content Manage System')?></span></h5>

                <h5><strong><?=Yii::t('app','Soft Edition')?></strong><span>1.0</span></h5>
                <h5><strong><?=Yii::t('app','Server Info')?></strong><span><?= $sysInfo['web_server']?></span></h5>
                <h5><strong><?=Yii::t('app','OS')?></strong><span><?= $sysInfo['os']?></span></h5>

                <h5><strong><?=Yii::t('app','PHP Edition')?></strong><span><?= $sysInfo['phpv']?></span></h5>
                <h5><strong><?=Yii::t('app','Zib Compress')?></strong><span><?= $sysInfo['zlib'] ? Yii::t('app','open'):Yii::t('app','close')?></span></h5>
                <h5><strong>Socket</strong><span><?= $sysInfo['socket'] ? Yii::t('app','open'):Yii::t('app','close')?></span></h5>
                <h5><strong><?=Yii::t('app','Upload Limit')?></strong><span><?= $sysInfo['fileupload']?></span></h5>


            </div>
        </div>
    </div>
</div>

<script src="<?= Yii::getAlias('@web/statics/admin/js/Chart.min.js') ?>"></script>

<script>
    //统计文件碎片
    $(function(){
        var $recycleTotal = $('#recycleTotal'),
            $recycleTxt = $('#recycleTxt');
        var oldTxt = $recycleTxt.text();

        $.get('?r=site/get-recycle',function(c){
            if(c.total ==0) {
                $recycleTotal.text(0);
                $recycleTxt.html('<?=Yii::t('app','Your system is clean no need clean up')?>');
            }
            if(c.total>0)
            {
                $recycleTotal.text(c.total);
                $recycleTxt.html('系统有碎片文件，<a href="">点此清理！</a>').find('a').click(function(e){
                    e.preventDefault();
                    var count = 0;
                    for(var i=0;i< c.files.length;i++)
                    {
                        $.get('?r=site/do-recycle&file='+ c.files[i],function(){
                            var newTotal = $recycleTotal.text()-1;
                            $recycleTotal.text(newTotal);
                            if(newTotal == 0)
                            {
                                $recycleTxt.text('碎片清理完毕，系统很干净！');
                            }
                            else
                            {
                                count++;
                            }

                        },'json')

                    }

                });

            }


        },'json')
    })

</script>


