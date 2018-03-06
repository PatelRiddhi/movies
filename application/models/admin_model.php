<?php
class Admin_Model extends My_Model 
{
	public function __construct()
	{
		parent::__construct();
		$this->table_name = 'admin';
	}
	public function check_data($data)
	{
		$this->db->where($data);
		$result = $this->db->get($this->table_name)->result_array();
		return $result;
	}


	public function get_role($username)
	{

		$this->db->select('role');
		$this->db->where('username',$username);
		$q = $this->db->get($this->table_name)->result_array();
		return $q;
	}
	
	public function get_role_id($role)
	{
		$this->db->select('id');
		$this->db->where('role', $role);
		return $this->db->get('role')->result_array();
	}

	public function get_access_data($role_id)
	{
		$this->db->where('r_id', $role_id);
		$q = $this->db->get('permission')->result_array();
		return $q;
	}
}