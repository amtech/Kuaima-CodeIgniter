<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/Myupload.php';
class Admin extends CI_Controller {
	function __construct(){
        parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
    }
	
	//加载登录页面
	public function index()
	{
		$this->load->view('admin/login');
	}
	
	//检查管理员账号
	public function check_admin()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$this->load->model('Admin_Model');
		$admin_detail = $this->Admin_Model->admin_check($username,$password);
		if(!empty($admin_detail)){
			//设置session
			$array = array(
				'admin_id'=>$admin_detail['id'],
				'admin_name'=>$admin_detail['user_name'],
			);
			$this->session->set_userdata($array);
			echo 'succ';
		}else{
			echo "failed";
		}
	}
	
	//添加管理员页面
	public function admin_add()
	{
		$admin_id = $this->session->userdata('admin_id');
		if(!empty($admin_id)){
	    	//配置菜单
	    	$data['menu'] = "admin";
	    	$data['menu_name'] = "admin_add";
			$this->load->view('admin/add',$data);
		}else{
			redirect("/admin/admin");
		}
	}
	
	//保存管理员
	public function admin_add_save()
	{
		$admin_id = $this->session->userdata('admin_id');
		if(!empty($admin_id)){
			$this->load->model('Admin_Model');
			$user_name = $this->input->post('user_name');
			$password = $this->input->post('password');
			$re_password = $this->input->post('re_password');
			header("Content-type:text/html;charset=utf-8");
			if($password == $re_password){
				$id = $this->Admin_Model->admin_save($user_name,$password);
				if($id){
					redirect("/admin/admin/admin_list");
				}else{
					echo "<script>alert('添加失败');history.go(-1);</script>";
				}
			}else{
				echo "<script>alert('两次密码不一致');history.go(-1);</script>";
			}
		}else{
			redirect("/admin/admin");
		}
	}
	
	//管理员列表界面
	public function admin_list()
	{
		$admin_id = $this->session->userdata('admin_id');
		if(!empty($admin_id)){
			$this->load->model('Admin_Model');
			
			//此配置文件可自行独立
			$this->load->library('pagination');
			$config['use_page_numbers'] = TRUE;
			$config['first_link'] = '««';
			$config['last_link'] = '»»';
			$config['next_link'] = 'next »';
			$config['prev_link'] = '« prev';

			$config['num_tag_open'] = '<li>';
			$config['num_tag_close'] = '</li>';
			$config['cur_tag_open'] = '<li class="current">';
			$config['cur_tag_close'] = '</li>';
			$config['prev_tag_open'] = '<li>';
			$config['prev_tag_close'] = '</li>';
			$config['next_tag_open'] = '<li>';
			$config['next_tag_close'] = '</li>';
			$config['first_tag_open'] = '<li>';
			$config['first_tag_close'] = '</li>';
			$config['last_tag_open'] = '<li>';
			$config['last_tag_close'] = '</li>';
			
			$config['base_url'] = base_url('/admin/admin/admin_list');
			$config['total_rows'] = $this->Admin_Model->get_admin_count();
			$config['per_page'] = 15;
			
			if($this->uri->segment(4) > 1){	
	            $page = $this->uri->segment(4) - 1;
	        } else {
	            $page = 0;
	        }
	        $offset = $config['per_page'] * $page;
			$data['admin_list'] = $this->Admin_Model->admin_list($config['per_page'],$offset);
			
			//初始化分页
			$this->load->library('pagination');
	   		$this->pagination->initialize($config);
	    	//配置菜单
	    	$data['menu'] = "admin";
	    	$data['menu_name'] = "admin_list";
			$this->load->view('admin/list',$data);
		}else{
			redirect("/admin/admin");
		}
	}
	
	//退出登录
	public function logout()
	{
		$this->session->sess_destroy();
		redirect("/admin/admin");
	}

}
