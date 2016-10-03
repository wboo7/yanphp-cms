<?php
namespace common\libs;
use common\helpers\File;
/**
 *  uploads.class.php 附件操作类
 *
 * @author              shejiluren
 * @lastmodify			2014-12-22
 */

class Uploads
{
	var $contentid;
	var $attachments;
	var $field;
	var $imageexts = array('gif', 'jpg', 'jpeg', 'png', 'bmp');
	var $uploadedfiles = array();
	var $downloadedfiles = array();
	var $error;
	var $upload_root;
	var $setting = array();
    var $uploadeds = 0;
	
	function __construct($upload_dir = '',$upload_root='') {

		$this->upload_root = $upload_root;
		$this->upload_func = 'copy';
		$this->upload_dir = $upload_dir;
		//自定义配置
		$this->setting['upload_maxsize'] = 2048;
		$this->setting['upload_allowext'] = 'jpg|jpeg|gif|bmp|png|doc|docx|xls|xlsx|ppt|pptx|pdf|txt|rar|zip|swf';
	}
	
	/**
	 * 附件上传方法
	 * @param $field 上传字段
	 * @param $alowexts 允许上传类型
	 * @param $maxsize 最大上传大小
	 * @param $overwrite 是否覆盖原有文件
	 * @param $thumb_setting 缩略图设置
	 * @param $watermark_enable  是否添加水印
	 */
	function upload($field, $alowexts = '', $maxsize = 0, $overwrite = 0, $thumb_setting = array(), $watermark_enable = 1) {
		if(!isset($_FILES[$field])) {
			$this->error = UPLOAD_ERR_OK;
			return false;
		}
		if(empty($alowexts) || $alowexts == '') {
			$alowexts = $this->setting['upload_allowext'];
		}
			
		$this->field = $field;
		$this->savepath = $this->upload_root.$this->upload_dir."/".date('Y/md/');
		$this->alowexts = $alowexts;
		$this->maxsize = $maxsize;
		$this->overwrite = $overwrite;
		$uploadfiles = array();
		if(is_array($_FILES[$field]['error'])) 
		{
			$this->uploads = count($_FILES[$field]['error']);
			foreach($_FILES[$field]['error'] as $key => $error) 
			{
				if($error === UPLOAD_ERR_NO_FILE) continue;
				if($error !== UPLOAD_ERR_OK) 
				{
					$this->error = $error;
					return false;
				}
				$uploadfiles[$key] = array('tmp_name' => $_FILES[$field]['tmp_name'][$key], 'name' => $_FILES[$field]['name'][$key], 'type' => $_FILES[$field]['type'][$key], 'size' => $_FILES[$field]['size'][$key], 'error' => $_FILES[$field]['error'][$key]);
			}
		} else {
			$this->uploads = 1;
			$uploadfiles[0] = array('tmp_name' => $_FILES[$field]['tmp_name'], 'name' => $_FILES[$field]['name'], 'type' => $_FILES[$field]['type'], 'size' => $_FILES[$field]['size'], 'error' => $_FILES[$field]['error']);
		}
	
		if(!File::dir_create($this->savepath))
		{
			$this->error = '8';
			return false;
		}
		if(!is_dir($this->savepath)) 
		{
			$this->error = '8';
			return false;
		}
		@chmod($this->savepath, 0777);
	
		if(!is_writeable($this->savepath)) 
		{
			$this->error = '9';
			return false;
		}
		if(!$this->is_allow_upload()) 
		{
			$this->error = '13';
			return false;
		}
		$aids = array();
		foreach($uploadfiles as $k=>$file) 
		{
			$fileext = File::fileext($file['name']);
			if($file['error'] != 0) 
			{
				$this->error = $file['error'];
				return false;
			}
			if(!preg_match("/^(".$this->alowexts.")$/", $fileext)) 
			{
				$this->error = '10';
				return false;
			}
			if($this->maxsize && $file['size'] > $this->maxsize) 
			{
				$this->error = '11';
				return false;
			}
			if(!$this->isuploadedfile($file['tmp_name'])) 
			{
				$this->error = '12';
				return false;
			}
			$temp_filename = $this->getname($fileext);
			$savefile = $this->savepath.$temp_filename;
			$savefile = preg_replace("/(php|phtml|php3|php4|jsp|exe|dll|asp|cer|asa|shtml|shtm|aspx|asax|cgi|fcgi|pl)(\.|$)/i", "_\\1\\2", $savefile);
			$filepath = preg_replace(File::new_addslashes("|^".$this->upload_root."|"), "", $savefile);
			if(!$this->overwrite && file_exists($savefile)) continue;
			$upload_func = $this->upload_func;
			if(@$upload_func($file['tmp_name'], $savefile)) 
			{
				$this->uploadeds++;
				@chmod($savefile, 0644);
				@unlink($file['tmp_name']);
				$file['name'] = $file['name'];
				$file['name'] = File::safe_replace($file['name']);
				$uploadedfile = array('filename'=>$file['name'], 'filepath'=>$filepath, 'filesize'=>$file['size'], 'fileext'=>$fileext);
//				$thumb_enable = is_array($thumb_setting) && ($thumb_setting[0] > 0 || $thumb_setting[1] > 0 ) ? 1 : 0;
//				$image = new image($thumb_enable);
//				if($thumb_enable)
//				{
//					$image->thumb($savefile, '', $thumb_setting[0], $thumb_setting[1]);
//				}
//				if($watermark_enable)
//				{
//					$image->watermark($savefile, $savefile);
//				}
			}
		}
		return $uploadedfile;
	}
	
	/**
	 * 获取缩略图地址..
	 * @param $image 图片路径
	 */
	function get_thumb($image)
	{
		return str_replace('.', '_thumb.', $image);
	}
	
	
	/**
	 * 获取附件名称
	 * @param $fileext 附件扩展名
	 */
	function getname($fileext)
	{
		return date('Ymdhis').rand(100, 999).'.'.$fileext;
	}
	
	/**
	 * 返回附件大小
	 * @param $filesize 图片大小
	 */
	
	function size($filesize) 
	{
		if($filesize >= 1073741824) 
		{
			$filesize = round($filesize / 1073741824 * 100) / 100 . ' GB';
		} elseif($filesize >= 1048576) 
		{
			$filesize = round($filesize / 1048576 * 100) / 100 . ' MB';
		} elseif($filesize >= 1024) 
		{
			$filesize = round($filesize / 1024 * 100) / 100 . ' KB';
		} else {
			$filesize = $filesize . ' Bytes';
		}
		return $filesize;
	}
	
	/**
	 * 判断文件是否是通过 HTTP POST 上传的
	 *
	 * @param	string	$file	文件地址
	 * @return	bool	所给出的文件是通过 HTTP POST 上传的则返回 TRUE
	 */
	function isuploadedfile($file) 
	{
		return is_uploaded_file($file) || is_uploaded_file(str_replace('\\\\', '\\', $file));
	}
	
	/**
	 * 是否允许上传
	 */
	function is_allow_upload() 
	{
        return true;
		return ($uploads < $this->setting['upload_maxsize']);
	}
	
	/**
	 * 返回错误信息
	 */
	function error() 
	{
		$UPLOAD_ERROR = array(
				0 => '文件上传成功',
				1 => '上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值',
				2 => '上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值',
				3 => '文件只有部分被上传',
				4 => '没有文件被上传',
				5 => '',
				6 => '找不到临时文件夹',
				7 => '文件写入临时文件夹失败',
				8 => '附件目录创建不成功',
				9 => '附件目录没有写入权限',
				10 => '不允许上传该类型文件',
				11 => '文件超过了管理员限定的大小',
				12 => '非法上传文件',
				13 => '24小时内上传附件个数超出了系统限制',
		);
		return $UPLOAD_ERROR[$this->error];
	}
}