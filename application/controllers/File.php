<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/Myupload.php';
class File extends CI_Controller {
	
	//上传页面
	public function index()
	{
		$this->load->view('file');
	}
	
	//保存上传图片
	public function file_save()
	{
		$ret = array();
		$upfile_data = $_FILES ['image'];
		if(!empty($upfile_data["name"])){
			$image_dir = 'image/';
			if(!is_dir($image_dir)){
				mkdir($image_dir,0777,TRUE);
			}
            //上传图片
            $array = array('filepath'=>$image_dir,'israndname'=>true,'allowtype'=>array('gif', 'jpg', 'png', 'jpeg'),'maxsize'=>'2048000');
            $obj = new Myupload($array);
            $obj->uploadFile('image');
            $images = $obj->getNewFileName();
			if($images){
				$img_domain = "http://img.night98.com/";//阿里云图片存储地址
				$img_arr['name'] = $images;
				$img_arr['path'] = $img_domain.$image_dir.$images; 
				$ret['status'] = 1;
				$ret['data'] = $img_arr;
				echo '<script>window.parent.image_save("'.$img_arr['path'].'","'.$img_arr['name'].'")</script>';
			}
			else{
				echo '<script>alert("上传失败")</script>';
			}
        }
	}
}
