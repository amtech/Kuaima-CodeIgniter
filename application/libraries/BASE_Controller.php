<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//��̨��½Ȩ��
class BASE_Controller extends CI_Controller {
	public $is_auth = false;//�Ƿ��Ѿ���¼
	public $admin_id = 0;
	function __construct()
    {
        parent::__construct();
		
		$this->load->library('session');
		$this->load->helper('url');
        $admin_id = $this->session->userdata('admin_id');
		
		if($admin_id){
			$this->is_auth = TRUE;
			$this->admin_id = $admin_id;
		}
    }
}
