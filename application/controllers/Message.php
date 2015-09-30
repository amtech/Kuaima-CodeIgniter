<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/MsgSend.php';//载入库文件
class Message extends CI_Controller {
	
	//激活平台账号
	public function index()
	{
		$m = new MsgSend();
		$h = $m->index();
	}
	
	//发送短信
	public function send()
	{
		$mobile = "15988888888";//手机号码格式
		$sign = "【xxx】";//签名格式
		$content = "XXXXXXXXXXX";//发送内容
		$m = new MsgSend();
		$h = $m->send_msg($mobile,$content.$sign);
	}
}
