<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Setting_model extends My_Model
{
 	public function __construct()
 	{
 		parent::__construct();
 		$this->table_name = 'role';
 	}	
 
	public function get_all()
	{
		return parent::get_all();
	}

	public function get_permission_id($id)
	{
		$this->db->select('permission');
		$this->db->where('r_id',$id);
		return $this->db->get('permission')->result_array();
	}

	public function remove($id, $permission)
	{
		$this->db->where('r_id', $id);
		$this->db->where('permission', $permission);
		return $this->db->delete('permission'); 
	}

	public function insert($data)
	{
			$this->table_name = 'permission';
			return parent::add($data);
	}

	public function get_modules()
	{
		return $this->db->get('modules')->result_array();
	}

	public function add($data, $table_name='')
	{
		if($table_name == 'modules')
		{
			$this->table_name= $table_name;
			return parent::add($data);
		}
		else if($table_name == 'role')
		{
			$this->table_name= $table_name;
			return parent::add($data);
		}
		else
		{
			return parent::add($data);
		}		
	}
 /* End of file setting_model.php */
 /* Location: ./application/models/setting_model.php */ 
}
?>