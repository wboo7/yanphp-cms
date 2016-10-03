
  <section class="section">
    <div class="step">
      <ul>
        <li class="current"><em>1</em>检测环境</li>
        <li><em>2</em>创建数据</li>
        <li><em>3</em>完成安装</li>
      </ul>
    </div>
    <div class="server">
      <table width="100%">
        <tr>
          <td class="td1">环境检测</td>
          <td class="td1" width="25%">推荐配置</td>
          <td class="td1" width="25%">当前状态</td>
          <td class="td1" width="25%">最低要求</td>
        </tr>
        <tr>
          <td>操作系统</td>
          <td>类UNIX</td>
          <td><span class="correct_span">&radic;</span> <?php echo $os; ?></td>
          <td>不限制</td>
        </tr>
        <tr>
          <td>PHP版本</td>
          <td>>5.4.x</td>
          <td><span class="correct_span">&radic;</span> <?php echo $phpv; ?></td>
          <td>5.2.0</td>
        </tr>
        <tr>
          <td>Mysql版本（client）</td>
          <td>>5.x.x</td>
          <td><?php echo $mysql; ?></td>
          <td>4.2</td>
        </tr>
        <tr>
          <td>附件上传</td>
          <td>>2M</td>
          <td><?php echo $uploadSize; ?></td>
          <td>不限制</td>
        </tr>
        <tr>
          <td>session</td>
          <td>开启</td>
          <td><?php echo $session; ?></td>
          <td>开启</td>
        </tr>
      </table>
      <table width="100%">
        <tr>
          <td class="td1">目录、文件权限检查</td>
          <td class="td1" width="25%">写入</td>
          <td class="td1" width="25%">读取</td>
        </tr>
<?php
function testwrite($d) {
    $tfile = "_test.txt";
    $fp = @fopen($d . "/" . $tfile, "w");
    if (!$fp) {
        return false;
    }
    fclose($fp);
    $rs = @unlink($d . "/" . $tfile);
    if ($rs) {
        return true;
    }
    return false;
}




function dir_create($path, $mode = 0777) {
    if (is_dir($path))
        return TRUE;
    $ftp_enable = 0;
    $path = dir_path($path);
    $temp = explode('/', $path);
    $cur_dir = '';
    $max = count($temp) - 1;
    for ($i = 0; $i < $max; $i++) {
        $cur_dir .= $temp[$i] . '/';
        if (@is_dir($cur_dir))
            continue;
        @mkdir($cur_dir, 0777, true);
        @chmod($cur_dir, 0777);
    }
    return is_dir($path);
}
function dir_path($path) {
    $path = str_replace('\\', '/', $path);
    if (substr($path, -1) != '/')
        $path = $path . '/';
    return $path;
}

foreach($folder as $dir){
     $Testdir = Yii::getAlias('@webroot/').$dir;
     dir_create($Testdir);
	 if(TestWrite($Testdir)){
	     $w = '<span class="correct_span">&radic;</span>可写 ';
	 }else{
	     $w = '<span class="correct_span error_span">&radic;</span>不可写 ';
		 $err++;
	 }
	 if(is_readable($Testdir)){
	     $r = '<span class="correct_span">&radic;</span>可读' ;
	 }else{
	     $r = '<span class="correct_span error_span">&radic;</span>不可读';
		 $err++;
	 }
?>
        <tr>
          <td><?php echo $dir; ?></td>
          <td><?php echo $w; ?></td>
          <td><?php echo $r; ?></td>
        </tr>
<?php
}
?>   
      </table>
    </div>
    <div class="bottom tac"> <a href="?step=2" class="btn">重新检测</a><a href="?step=3" class="btn">下一步</a> </div>
  </section>
</div>
