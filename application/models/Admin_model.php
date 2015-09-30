<?php
/**
 *  Admin Model
 * 
**/
class Admin_Model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	//管理员登录(密码md5加密)
	public function admin_check($user_name,$password)
	{
		$this->db->select('id,user_name');
		$this->db->where('user_name',$user_name);
		$this->db->where('password',md5($password));
		$query = $this->db->get('admin_users');
		
		$admin_detail = $query->row_array();
		return $admin_detail;
	}
	
	//管理员总数
	public function get_admin_count()
	{
		$this->db->select('id');
        $this->db->from('admin_users');
        
        $total = $this->db->count_all_results();
		return $total;
	}
	
	//管理员列表
	public function admin_list($num=15,$offset=0)
	{
		$this->db->select('*');
		$this->db->from('admin_users');
		$this->db->order_by('id','desc');
		$this->db->limit($num,$offset);
		$query = $this->db->get();
		
		$list = $query->result_array();
		
		return $list;
	}
	
	//保存管理员账号
	public function admin_save($user_name,$password)
	{
		$data = array(
			'user_name'=>$user_name,
			'password'=>md5($password),
		);
		
		$this->db->insert('admin_users',$data);
		return $this->db->insert_id();
	}
}
?>