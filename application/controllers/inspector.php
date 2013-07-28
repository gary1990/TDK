<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Inspector extends CW_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('grocery_CRUD');
	}
	
	public function index()
	{
		$crud = new grocery_CRUD();
		$crud->set_table('inspector');
		$crud->set_theme('datatables');
		$crud->required_fields('name');
		$crud->display_as('name', 'Name')
			 ->display_as('username', 'EmpNo')
			 ->display_as('password', 'Password');
		$crud->unset_export();
		$crud->unset_print();
		$crud->set_rules('password','password','callback_check_user_password');
		
		//新增，编辑时对ussername的判断
		$postUrl = $this->uri->uri_string();
		if(strpos($postUrl, "insert_validation") != FALSE)
		{
			$crud->set_rules('username','EmpNo','callback_add_username');
		}
		else if(strpos($postUrl, "update_validation") != FALSE)
		{
			$crud->set_rules('username','EmpNo','callback_edit_username');
		}
		else
		{
			//
		}
		$output = $crud->render();
		
		foreach ($output as $key=>$value)
		{
			$this->smarty->assign($key, $value);
		}
		$this->smarty->assign("currenmenu","inspector");
		$this->smarty->display("user.tpl");
	}
	
	public function add_username($str)
	{
		if(preg_match("/^[a-zA-Z0-9]+$/", $str))
		{
			$nameRecordObj = $this->db->query("SELECT a.username FROM inspector a WHERE a.username = '$str'");
			if($nameRecordObj->num_rows() != 0)
			{
				$this->form_validation->set_message('add_username', 'This EmpNo already exists');
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
		else
		{
			$this->form_validation->set_message('add_username', 'EmpNo is required and must character or number');
			return FALSE;
		}
	}
	//编辑时对用户名的验证
	public function edit_username($str)
	{
		if(preg_match("/^[a-zA-Z0-9]+$/", $str))
		{
			//取得当前id
			$postUrl = $this->uri->uri_string();
			$id = substr($postUrl, strripos($postUrl, "/")+1);
			//查询id不等于当前，且测试站点名称等于当前输入的测试站点名称的记录数
			$numObj = $this->db->query("SELECT COUNT(*) AS num FROM inspector ur WHERE ur.username = '$str' AND ur.id != '$id'");
			$num = $numObj->first_row()->num;
			//记录为空时允许修改，不为空时，不允许修改
			if($num != 0)
			{
				$this->form_validation->set_message('edit_username', 'This EmpNo already exists.');
				return FALSE;
			}
			else
			{
				return TRUE;
			}
		}
		else
		{
			$this->form_validation->set_message('edit_username', 'EmpNo is required and must character or number');
			return FALSE;
		}
	}
	
	//对密码的格式校验
	public function check_user_password($str)
	{
		if(strlen($str) < 6)
		{
			$this->form_validation->set_message('check_user_password', 'Password should character or number must more than six.');
			return FALSE;
		}
		else
		{
			if(preg_match("/^[a-zA-Z0-9]+$/", $str))
			{
				return TRUE;
			}
			else
			{
				$this->form_validation->set_message('check_user_password', 'Password should character or number must more than six.');
				return FALSE;
			}
		}
	}	
}