<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . '/libraries/ServerAPI.php';
class Chat extends REST_Controller {
	
	private $user_id = 1;//用户id(此处默认为1,开发时候，请自行进行替换)
	private $appKey = '';                //您的appKey
    private $appSecret = '';             //您的secret
    const   SERVERAPIURL = 'https://api.cn.rong.io';    //请求服务地址
    
	function __construct(){
        parent::__construct();
		$this->load->library('session');
		$this->user_id = $this->session->userdata('user_id');
    }
	
	//生存签名(当前登录用户)
	public function get_token_get()
	{
		$ret = array();
		$user_id = $this->user_id;
		if(!empty($user_id)){
			//获取用户id之后，自主进行数据库查询操作，将用户的昵称以及头像查询出来，此处假设返回值为$user_info,数组格式
			$user_info = array('id'=>1,'nickname'=>"昵称","profile_pic"=>"头像路径",'ry_token'=>'');
			
			if(!empty($user_info['ry_token'])){
				
				$obj = new ServerAPI($this->appKey,$this->appSecret);
				$token_info = $obj->getToken($user_id, $user_info['nickname'], $user_info['profile_pic']);
				$token_arr = json_decode($token_info);
				
				if($token_arr->code == '200'){
					//获取token成功之后，请自主存入数据库，此处只返回数据
					$ret['status'] = 1;
					$ret['token'] = $token_arr->token;
					$ret['msg'] = "获取成功";
				}else{
					$ret['status'] = -1;
					$ret['msg'] = "获取失败";
				}
			}else{
				$ret['status'] = 1;
				$ret['token'] = $user_info['ry_token'];
			}
		}else{
			$ret['status'] = -1;
			$ret['msg'] = "请先登录";
		}
		
		$this->response($ret);
	}
	
	//生成签名(聊天用户)
	public function get_token_by_user_get()
	{
		$ret = array();
		$user_id = $this->input->get('user_id');
		//获取用户信息
		if($user_id){
			//查询数据库返回该用户的详细信息，此处假设查询返回的结果为$user_info，数组格式
			$user_info = array('id'=>2,'nickname'=>"昵称","profile_pic"=>"头像路径",'ry_token'=>'');
			if(!empty($user_info)){
				//检查是否为第一次请求融云
				if(empty($user_info['rytoken'])){
					$obj = new ServerAPI($this->appKey,$this->appSecret);
					$token_info = $obj->getToken($user_id, $user_info['nickname'], $user_info['profile_pic']);
					$token_arr = json_decode($token_info);
					if($token_arr->code == '200'){
						//获取token成功之后，请自主存入数据库，此处只返回数据
						$ret['status'] = 1;
						$ret['token'] = $token_arr->token;
					}else{
						$ret['status'] = -1;
						$ret['msg'] = "获取失败";
					}
				}else{
					$ret['status'] = 1;
					$ret['token'] = $user_info['ry_token'];
				}
			}else{
				$ret['status'] = -1;
				$ret['msg'] = "参数错误";
			}
		}else{
			$ret['status'] = -1;
			$ret['msg'] = "参数错误";
		}
		
		$this->response($ret);
	}
}