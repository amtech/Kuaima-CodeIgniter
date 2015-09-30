<?php defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');
require(APPPATH.'/libraries/IGt/AppPush.php');
class Getui extends REST_Controller {
	private $user_id = 0;
    
	function __construct(){
        parent::__construct();
		$this->load->library('session');
		$this->user_id = $this->session->userdata('user_id');
		$this->load->helper('url');
    }
    
    //个推（推送时，需要将用户id与设备token进行关联）
    public function index()
    {
		$user_id = 1;//用户id
		$token = "";//设备token
		$apppush = new AppPush();
		$push_info = $apppush->pushMessageToSingle($user_id,"推送内容","推送内容","推送内容","推送内容");//安卓推送
		$push_info_ios = $apppush->pushios($token,"推送内容","推送内容");//ios推送
	}
}
